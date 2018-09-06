/*******************************************************************************
 * _class.articlePositions.js * for all rows with articlePositions Parameter:
 * parameter1: supplierFirmID parameter2: formID (dialog-auftragspositionen)
 * 
 * public variables: postblock: after loading Article-List, trPositions()
 * htmlOrderPositions: html-block for html-rows of articles public rows
 * this.rowsArticle=new Array; Articles of su0pplier this.autoCompleteArticle =
 * new Array; bind autocomplete to formfield article_code this.rowsVariations =
 * new Array; p17_article_variations id, variation_group_id, name
 * this.rowsVGroup = new Array(); p17_article_variation_group id, firmID, name
 * this.rowsSpec = new Array(); p17_article_variation_spec id, article_id,
 * variation1_id, variation2_id, quantity_unit, price .... this.rowsSet = new
 * Array(); p17_article_set id, set_article_id, set_spec_id, list of content:
 * article_id, spec_id, quantity
 * 
 * public methods: get Article() List of supplier store to changeArticle(ifield)
 * if ifield: article_code -> changeArticle_article_code otherwise switch
 * changeVariation1 changeVariation2
 * 
 * @attention: ajax has his own "this" => myClass=this
 * 
 * 
 */

function _ArticlePosition(psupplierFirmID, pkindArticles) {
	if (arguments.length < 1) {
		this._supplierFirmID = _session.firmID;
	} else {
		this._supplierFirmID = psupplierFirmID;
	}

	if (arguments.length < 2) {
		this._kindArticles = "S";
	} else {
		this._kindArticles = pkindArticles;
	}

	// public vars
	console.log("weclcome to class _ArticlePosition");

	// defined by calling function
	this._phpSavePosition = "";
	this._rowsPositions = new Array();

	this._dialogPositions = "dialog-auftragspositionen";
	this._dialogInvoice = "dialog-auftragserfassung";
	this._compareInvoice = false;

	this._tbodyID = "orderpositions";

	this.$frmP = $("form#" + this._dialogPositions);
	this.$frm = $("form#" + this._dialogInvoice);

	// RechenAutomatik
	this._autoCalc = true;

	this.rowsArticle = new Array;
	this.autoCompleteArticle = new Array();
	this.rowsVariations = new Array();
	this.rowsVGroup = new Array();
	this.rowsSpec = new Array();
	this.rowsSet = new Array();
	this.rowsVAT = new Array();

	// content of block
	this.htmlOrderPositions = "";

}

/**
 * define subordinated prototypes
 */
_ArticlePosition.prototype._getArticles = function() {
	var myClass = this;

	var data = {
		"action" : "init",
		"firmID" : this._supplierFirmID,
		"kind" : this._kindArticles
	};
	$.ajax({
		type : "POST",
		dataType : "json",
		url : "../../supplier_getArticle.php",
		data : data,
		success : function(data) {
			var array_data = getDataContent(data);
			// console.log(array_data);
			/**
			 * autoCompleteArticle, rowsArticle, rowsVariations, rowsVGroup,
			 * rowsSpec should be defined by calling function as public
			 */

			myClass.rowsArticle = array_data["rowsArticle"];
			myClass.rowsVariations = array_data["rowsVariations"];
			myClass.rowsVGroup = array_data["rowsVGroup"];
			myClass.rowsSpec = array_data["rowsSpec"];
			myClass.rowsSet = array_data["rowsSet"];
			myClass.rowsVAT = array_data["rowsVAT"];

			myClass.initDialog();

		} // end ajax success

	}); // end ajax

	return;

}

_ArticlePosition.prototype.initDialog = function() {
	this.$frmP = $("form#" + this._dialogPositions);
	myClass = this;

	for (var i = 0; i < this.rowsArticle.length; i++) {
		if (this.rowsArticle[i].isSet == 1) {
			var setAsterix = "* ";
		} else {
			var setAsterix = "";
		}
		this.autoCompleteArticle[i] = {
			'value' : this.rowsArticle[i].article_code,
			'label' : setAsterix + this.rowsArticle[i].article_code + ' '
					+ this.rowsArticle[i].name
		};
	}

	this.$frmP.find('select[name="vat_id"]').find('option').remove().end();

	for (var i = 0; i < this.rowsVAT.length; i++) {

		this.$frmP
				.find('select[name="vat_id"]')
				.append(
						new Option(
								this.rowsVAT[i].vat_id
										+ ' '
										+ germanDezimal(this.rowsVAT[i].percentage * 100)
										+ '%', this.rowsVAT[i].vat_id));
	}

	/**
	 * bind autoCompleteArticle to input field article_code
	 */

	this.$frmP.find('input[name="article_code"]').autocomplete({
		source : this.autoCompleteArticle,
		minLength : 0
	});

	/**
	 * bind change to input fields
	 */

	if (this.$frmP.find('input[name="article_code"]').length > 0)
		this.$frmP.find('input[name="article_code"]').blur(function() {
			myClass.changeArticle('article_code');
		});

	if (this.$frmP.find('input[name="quantity"]').length > 0)
		this.$frmP.find('input[name="quantity"]').change(function() {
			myClass.changeArticle('quantity');
		});

	if (this.$frmP.find('input[name="price"]').length > 0)
		this.$frmP.find('input[name="price"]').change(function() {
			myClass.changeArticle('price');
		});

	if (this.$frmP.find('input[name="retourCredit"]').length > 0)
		this.$frmP.find('input[name="retourCredit"]').change(function() {
			myClass.changeArticle('retourCredit');
		});

	if (this.$frmP.find('input[name="discount"]').length > 0)
		this.$frmP.find('input[name="discount"]').change(function() {
			myClass.changeArticle('discount');
		});

	if (this.$frmP.find('input[name="variation1_id"]').length > 0)
		this.$frmP.find('select[name="variation1_id"]').change(function() {
			myClass.changeVariation1();
		});

	if (this.$frmP.find('input[name="variation1_id"]').length > 0)
		this.$frmP.find('select[name="variation2_id"]').change(function() {
			myClass.changeVariation2();
		});

	this._trOrderPositions();

}

_ArticlePosition.prototype.changeArticle = function(ifield) {

	switch (ifield) {
	case "article_code":
		this.changeArticle_article_code();
		break;
	case "retourCredit":
		if (this._autoCalc) {
			var price = comma2dot(this.$frmP.find('input[name="retourCredit"]')
					.val());
			var quantity = comma2dot(this.$frmP.find('input[name="quantity"]')
					.val());
			this.$frmP.find('input[name="sumPosition"]').val(
					germanDezimal(quantity * price));
		}

		break;
	default:

		if (this._autoCalc) {
			var price = comma2dot(this.$frmP.find('input[name="price"]').val());
			var quantity = comma2dot(this.$frmP.find('input[name="quantity"]')
					.val());
			var discount = comma2dot(this.$frmP.find('input[name="discount"]')
					.val());
			this.$frmP.find('input[name="sumPosition"]').val(
					germanDezimal(quantity * price * (1 - discount / 100)));
		}
		break;
	}

	return;
}

_ArticlePosition.prototype.changeArticle_article_code = function() {
	myClass = this;

	var value = this.$frmP.find('input[name="article_code"]').val();
	console.log(value);
	for (var i = 0; i < this.rowsArticle.length; i++) {

		if (this.rowsArticle[i].article_code == value) {
			if (this.$frmP.find('input[name="article_id"]').val() == undefined)
				alert("define article_id as hidden field");
			this.$frmP.find('input[name="article_id"]').val(
					this.rowsArticle[i].id);
			this.$frmP.find('input[name="name"]').val(this.rowsArticle[i].name);
			this.$frmP.find('input[name="price"]').val(
					germanDezimal(this.rowsArticle[i].price));
			this.$frmP.find('input[name="retourCredit"]').val(
					germanDezimal(this.rowsArticle[i].retourCredit));
			this.$frmP.find('input[name="quantity_unit"]').val(
					this.rowsArticle[i].quantity_unit);
			this.$frmP.find('select[name="vat_id"]').val(
					this.rowsArticle[i].vat_id);

			/**
			 * perhaps purchase V add 6
			 */
			if (this.$frmP.find('select[name="vat_id"]').val() == null) {
				this.$frmP.find('select[name="vat_id"]').val(
						parseInt(this.rowsArticle[i].vat_id) + 6);
			}

		}
	}

	// get variations
	// get first occurance in rowsSpec
	var variation1_id = 0;
	var variation2_id = 0;
	var variation_group_id = 0;

	var article_id = this.$frmP.find('input[name="article_id"]').val();

	for (var i = 0; i < this.rowsSpec.length; i++) {
		if (this.rowsSpec[i].article_id == article_id) {
			variation1_id = this.rowsSpec[i].variation1_id;
			variation2_id = this.rowsSpec[i].variation2_id;
			break;
		}
	}

	// get variation group dependent from variation1_id or variation2_id
	for (var i = 0; i < this.rowsVariations.length; i++) {
		if (this.rowsVariations[i].id == variation1_id) {
			variation_group_id = this.rowsVariations[i].variation_group_id;
			break;
		}
	}

	this.$frmP.find('select[name="variation1_id"]').find('option').remove()
			.end();
	this.$frmP.find('select[name="variation2_id"]').find('option').remove()
			.end();

	for (var i = 0; i < this.rowsVariations.length; i++) {
		if (this.rowsVariations[i].variation_group_id == variation_group_id) {
			this.$frmP.find('select[name="variation1_id"]').append(
					new Option(this.rowsVariations[i].name,
							this.rowsVariations[i].id));

		}
	}

	/*
	 * bind changeVariation1 to variation1_id dependig from variation1_id get
	 * the option-list of variation2
	 */

	this.$frmP.find('select[name="variation1_id"]').change(function() {
		myClass.changeVariation1();
	});
	myClass.changeVariation1();

	return;
}

_ArticlePosition.prototype.changeVariation1 = function() {
	myClass = this;
	var article_id = 0;
	var variation1_id = 0;
	var variation2_id = 0;
	var variation_group_id = 0;

	// get article_id
	var article_id = this.$frmP.find('input[name="article_id"]').val();

	// seconde get variation1_id
	variation1_id = this.$frmP.find('select[name="variation1_id"]').val();

	// remove older variation2_id
	this.$frmP.find('select[name="variation2_id"]').find('option').remove()
			.end();

	// get variation2_id depending from variation1_id
	for (var i = 0; i < this.rowsSpec.length; i++) {
		if (this.rowsSpec[i].article_id == article_id
				&& this.rowsSpec[i].variation1_id == variation1_id
				&& this.rowsSpec[i].variation2_id > 0) {
			variation2_id = this.rowsSpec[i].variation2_id;
			for (ii = 0; ii < this.rowsVariations.length; ii++) {
				if (this.rowsVariations[ii].id == variation2_id)
					this.$frmP.find('select[name="variation2_id"]').append(
							new Option(this.rowsVariations[ii].name,
									variation2_id));
			}
			// break;
		}
	}

	myClass.changeVariation2();
	return

}

_ArticlePosition.prototype.changeVariation2 = function() {
	myClass = this;
	var variation1_id = this.$frmP.find('select[name="variation1_id"]').val();
	var variation2_id = this.$frmP.find('select[name="variation2_id"]').val();
	var article_code = this.$frmP.find('input[name="article_code"]').val();
	if (variation1_id == null)
		variation1_id = 0;
	if (variation2_id == null)
		variation2_id = 0;

	var article_id = this.$frmP.find('input[name="article_id"]').val();

	for (var i = 0; i < this.rowsSpec.length; i++) {
		if (this.rowsSpec[i].article_id == article_id
				&& this.rowsSpec[i].variation1_id == variation1_id
				&& this.rowsSpec[i].variation2_id == variation2_id) {
			this.$frmP.find('input[name="price"]').val(
					germanDezimal(this.rowsSpec[i].price));
			this.$frmP.find('input[name="retourCredit"]').val(
					germanDezimal(this.rowsSpec[i].retourCredit));
			this.$frmP.find('input[name="quantity_unit"]').val(
					this.rowsSpec[i].quantity_unit);
			break;
		}
	}

	return;
}

_ArticlePosition.prototype._trOrderPositions = function(rows) {
	/*
	 * problems @see: calling js auftrag.js -> auftrag_init called twice :-(
	 */

	var myClass = this;
	$frmP = $("form#" + myClass._dialogPositions);

	if (arguments.length < 1)
		var rows = this._rowsPositions;

	var string = "";
	var template = "";

	if (this.htmlOrderPositions == "") {
		if (this._tbodyID == "")
			_tbodyID = "orderpositions";
		this.htmlOrderPositions = $('#' + this._tbodyID).html();
	} else {
	}

	if (rows.length == 0) {
		template = this.htmlOrderPositions;
		if (template == undefined)
			template = "";
		while (template.indexOf("[i]") != -1)
			template = template.replace("[i]", '');
		while (template.indexOf("[article_code]") != -1)
			template = template.replace("[article_code]", '');
		while (template.indexOf("[name]") != -1)
			template = template.replace("[name]", '');
		while (template.indexOf("[variation1]") != -1)
			template = template.replace("[variation1]", '');
		while (template.indexOf("[variation2]") != -1)
			template = template.replace("[variation2]", '');
		while (template.indexOf("[variation1_name]") != -1)
			template = template.replace("[variation1_name]", '');
		while (template.indexOf("[variation2_name]") != -1)
			template = template.replace("[variation2_name]", '');
		while (template.indexOf("[quantity]") != -1)
			template = template.replace("[quantity]", '');
		while (template.indexOf("[quantity_unit]") != -1)
			template = template.replace("[quantity_unit]", '');
		while (template.indexOf("[price]") != -1)
			template = template.replace("[price]", '');
		while (template.indexOf("[retourCredit]") != -1)
			template = template.replace("[retourCredit]", '');
		while (template.indexOf("[discount]") != -1)
			template = template.replace("[discount]", '');
		while (template.indexOf("[sumPosition]") != -1)
			template = template.replace("[sumPosition]", '');
		while (template.indexOf("[percentage]") != -1)
			template = template.replace("[percentage]", '');
		while (template.indexOf("[faultID]") != -1)
			template = template.replace("[faultID]", '');
		while (template.indexOf("[fault]") != -1)
			template = template.replace("[fault]", '');
		while (template.indexOf("[stockP]") != -1)
			template = template.replace("[stockP]", '');
		while (template.indexOf("[stockI]") != -1)
			template = template.replace("[stockI]", '');
		while (template.indexOf("[stockR]") != -1)
			template = template.replace("[stockR]", '');
		while (template.indexOf("[stockO]") != -1)
			template = template.replace("[stockO]", '');
		while (template.indexOf("[content]") != -1)
			template = template.replace("[content]", '');
		while (template.indexOf("[weight]") != -1)
			template = template.replace("[weight]", '');
		while (template.indexOf("[gross_weight]") != -1)
			template = template.replace("[gross_weight]", '');
		string = template;
	}

	for (var i = 0; i < rows.length; i++) {
		template = this.htmlOrderPositions;
		row = rows[i];
		while (template.indexOf("[i]") != -1)
			template = template.replace("[i]", i);
		while (template.indexOf("[id]") != -1)
			template = template.replace("[id]", row.id);
		while (template.indexOf("[article_code]") != -1)
			template = template.replace("[article_code]", row.article_code);
		while (template.indexOf("[name]") != -1)
			template = template.replace("[name]", row.name);
		while (template.indexOf("[variation1]") != -1)
			template = template.replace("[variation1]", row.variation1_name);
		while (template.indexOf("[variation2]") != -1)
			template = template.replace("[variation2]", row.variation2_name);
		while (template.indexOf("[variation1_name]") != -1)
			template = template.replace("[variation1_name]",
					row.variation1_name);
		while (template.indexOf("[variation2_name]") != -1)
			template = template.replace("[variation2_name]",
					row.variation2_name);
		while (template.indexOf("[text]") != -1)
			template = template.replace("[text]", row.text);
		while (template.indexOf("[content]") != -1)
			template = template.replace("[content]", row.content);
		while (template.indexOf("[quantity]") != -1)
			template = template.replace("[quantity]",
					germanDezimal(row.quantity));
		while (template.indexOf("[quantity_unit]") != -1)
			template = template.replace("[quantity_unit]", row.quantity_unit);
		while (template.indexOf("[price]") != -1)
			template = template.replace("[price]", germanDezimal(row.price));
		while (template.indexOf("[retourCredit]") != -1)
			template = template.replace("[retourCredit]",
					germanDezimal(row.retourCredit));
		while (template.indexOf("[discount]") != -1)
			template = template.replace("[discount]",
					germanDezimal(row.discount));
		while (template.indexOf("[sumPosition]") != -1)
			template = template.replace("[sumPosition]",
					germanDezimal(row.sumPosition));
		while (template.indexOf("[percentage]") != -1)
			template = template.replace("[percentage]",
					germanDezimal(row.percentage * 100));

		while (template.indexOf("[faultID]") != -1)
			template = template.replace("[faultID]", (row.faultID == 0) ? ''
					: (row.faultID == 2) ? 'Mangel' : 'OK');
		while (template.indexOf("[fault]") != -1)
			template = template.replace("[fault]", row.fault);

		while (template.indexOf("[stockP]") != -1)
			template = template
					.replace(
							"[stockP]",
							(isStock(row.id, 'P') == "OK") ? '<span class="ui-icon ui-icon-check"></span>'
									: '');
		while (template.indexOf("[stockI]") != -1)
			template = template
					.replace(
							"[stockI]",
							(isStock(row.id, 'I') == "OK") ? '<span class="ui-icon ui-icon-check"></span>'
									: '');
		while (template.indexOf("[stockR]") != -1)
			template = template
					.replace(
							"[stockR]",
							(isStock(row.id, 'R') == "OK") ? '<span class="ui-icon ui-icon-check"></span>'
									: '');
		while (template.indexOf("[stockO]") != -1)
			template = template
					.replace(
							"[stockO]",
							(isStock(row.id, 'O') == "OK") ? '<span class="ui-icon ui-icon-check"></span>'
									: '');

		while (template.indexOf("[weight]") != -1)
			template = template.replace("[weight]", germanDezimal(row.weight));
		while (template.indexOf("[gross_weight]") != -1)
			template = template.replace("[gross_weight]",
					germanDezimal(row.gross_weight));
		string += template;
	}

	$('#' + this._tbodyID).html(string);
	$('#' + this._tbodyID + ' tr:odd').css("background-color", "#EFF1F1");

	// var this.$frmP = $("form#"+this._dialogPositions);
	this.$frmP.find('input[name="article_code"]').val('');
	this.$frmP.find('input[name="name"]').val('');
	this.$frmP.find('select[name="variation1_id"]').find('option').remove()
			.end();
	this.$frmP.find('select[name="variation2_id"]').find('option').remove()
			.end();
	this.$frmP.find('input[name="quantity"]').val('');
	this.$frmP.find('input[name="unity"]').val('');
	this.$frmP.find('input[name="price"]').val('');
	this.$frmP.find('input[name="retourCredit"]').val('');
	this.$frmP.find('input[name="text"]').val('');
	this.$frmP.find('input[name="discount"]').val('');
	this.$frmP.find('input[name="sumPosition"]').val('');
	this.$frmP.find('input[name="weight"]').val('');
	this.$frmP.find('input[name="gross_weight"]').val('');

	this._invoiceTotal();

}

_ArticlePosition.prototype._invoiceTotal = function() {

	if (this._autoCalc == false)
		return;
	if (this._dialogInvoice == "")
		return;
	this.$frm = $("form#" + this._dialogInvoice);

	
	if (this._compareInvoice)
		if (this.$frm.find('input[name="merchandiseNetVn"]').val()!="" ||
			this.$frm.find('input[name="merchandiseNetVr"]').val()!="" ||
			this.$frm.find('input[name="netValue"]').val()!="" ||
			this.$frm.find('input[name="grossValue"]').val()!="" ||
			this.$frm.find('input[name="paymentAmount"]').val()!=""
			&& !this._autoCalc) 
			this.compare=true;
	
	
	var merchandiseNetVn = 0;
	var merchandiseNetVr = 0;
	var packageNetVn = 0;
	var packageNetVr = 0;
	var dispatchNetVn = 0;
	var dispatchNetVr = 0;
	var NetVn = 0;
	var NetVr = 0;
	var VATn = 0;
	var VATr = 0;
	var grossValue = 0;
	var tradeDiscount = 0;
	var paymentAmount = 0;
	var percentage = 0.03;
	for (var i = 0; i < this._rowsPositions.length; i++) {

		if (this._rowsPositions[i].percentage == 0.19) {
			merchandiseNetVn += parseFloat(this._rowsPositions[i].sumPosition);
		} else {
			merchandiseNetVr += parseFloat(this._rowsPositions[i].sumPosition);
		}

	}

	// package and dispatch

	var packingCost = parseFloat(comma2dot(this.$frm.find(
			'input[name="packingCost"]').val()));
	var shippingCosts = parseFloat(comma2dot(this.$frm.find(
			'input[name="shippingCosts"]').val()));

	if (isNaN(packingCost))
		packingCost = 0;
	if (isNaN(shippingCosts))
		shippingCosts = 0;

	if (this.$frm.find('input[name="deliveryCondition"]').val() == "frei") {
		shippingCosts = 0;
	}

	var termPayment = this.$frm.find('select[name="termPayment"]').val();

	if (merchandiseNetVn != 0 && merchandiseNetVr == 0) {
		packageNetVn = packingCost;
		dispatchNetVn = shippingCosts;
	}

	if (merchandiseNetVn == 0 && merchandiseNetVr != 0) {
		packageNetVr = packingCost;
		dispatchNetVr = shippingCosts;
	}

	if (merchandiseNetVn != 0 && merchandiseNetVr != 0) {
		var shareVn = merchandiseNetVn / (merchandiseNetVn + merchandiseNetVr);
		var shareVr = 1 - shareVn;

		packageNetVn = packingCost * shareVn;
		dispatchNetVn = shippingCosts * shareVn;
		packageNetVr = packingCost - packageNetVn;
		dispatchNetVr = shippingCosts - dispatchNetVn;
	}

	VATn = (merchandiseNetVn + packageNetVn + dispatchNetVn) * 0.19;
	VATr = (merchandiseNetVr + packageNetVr + dispatchNetVr) * 0.07;

	grossValue = merchandiseNetVn + merchandiseNetVr + packageNetVn
			+ packageNetVr + dispatchNetVn + dispatchNetVr + VATn + VATr;

	/**
	 * rowsPayment
	 * 
	 * @see: verkauf.js
	 */

	for (var i = 0; i < rowsPayment.length; i++) {
		if (rowsPayment[i].id == termPayment) {
			percentage = parseFloat(rowsPayment[i].discount) / 100;
			break;
		}
	}

	tradeDiscount = merchandiseNetVn * percentage * 1.19 + merchandiseNetVr
			* percentage * 1.07;

	paymentAmount = grossValue - tradeDiscount;

	if (this._compareInvoice) {
		if (germanDezimal(merchandiseNetVn.toFixed(2))==
			this.$frm.find('input[name="merchandiseNetVn"]').val()) {
			this.$frm.find('input[name="merchandiseNetVn"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="merchandiseNetVn"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(merchandiseNetVr.toFixed(2))==
			this.$frm.find('input[name="merchandiseNetVr"]').val()) {
			this.$frm.find('input[name="merchandiseNetVr"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="merchandiseNetVr"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal((merchandiseNetVn + merchandiseNetVr).toFixed(2))==
			this.$frm.find('input[name="merchandiseNetTo"]').val()) {
			this.$frm.find('input[name="merchandiseNetTo"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="merchandiseNetTo"]').css("background-color","#ffdfdf");
			}	

		if (germanDezimal(packageNetVn.toFixed(2))==
			this.$frm.find('input[name="packageNetVn"]').val()) {
			this.$frm.find('input[name="packageNetVn"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="packageNetVn"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(packageNetVr.toFixed(2))==
			this.$frm.find('input[name="packageNetVr"]').val()) {
			this.$frm.find('input[name="packageNetVr"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="packageNetVr"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal((packageNetVn + packageNetVr).toFixed(2))==
			this.$frm.find('input[name="packageNetTo"]').val()) {
			this.$frm.find('input[name="packageNetTo"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="packageNetTo"]').css("background-color","#ffdfdf");
			}	

		if (germanDezimal(packageNetVn.toFixed(2))==
			this.$frm.find('input[name="dispatchNetVn"]').val()) {
			this.$frm.find('input[name="dispatchNetVn"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="dispatchNetVn"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(dispatchNetVr.toFixed(2))==
			this.$frm.find('input[name="dispatchNetVr"]').val()) {
			this.$frm.find('input[name="dispatchNetVr"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="dispatchNetVr"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal((dispatchNetVn + dispatchNetVr).toFixed(2))==
			this.$frm.find('input[name="dispatchNetTo"]').val()) {
			this.$frm.find('input[name="dispatchNetTo"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="dispatchNetTo"]').css("background-color","#ffdfdf");
			}	

		if (germanDezimal((merchandiseNetVn + merchandiseNetVr
					+ dispatchNetVn + dispatchNetVr).toFixed(2))==
			this.$frm.find('input[name="netValue"]').val()) {
			this.$frm.find('input[name="netValue"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="netValue"]').css("background-color","#ffdfdf");
			}	

		if (germanDezimal(VATn.toFixed(2))==
			this.$frm.find('input[name="VATn"]').val()) {
			this.$frm.find('input[name="VATn"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="VATn"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(VATr.toFixed(2))==
			this.$frm.find('input[name="VATr"]').val()) {
			this.$frm.find('input[name="VATr"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="VATr"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal((VATn + VATr).toFixed(2))==
			this.$frm.find('input[name="VATTo"]').val()) {
			this.$frm.find('input[name="VATTo"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="VATTo"]').css("background-color","#ffdfdf");
			}	

		if (germanDezimal(grossValue.toFixed(2))==
			this.$frm.find('input[name="grossValue"]').val()) {
			this.$frm.find('input[name="grossValue"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="grossValue"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(tradeDiscount.toFixed(2))==
			this.$frm.find('input[name="tradeDiscount"]').val()) {
			this.$frm.find('input[name="tradeDiscount"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="tradeDiscount"]').css("background-color","#ffdfdf");
			}	
		if (germanDezimal(paymentAmount.toFixed(2))==
			this.$frm.find('input[name="paymentAmount"]').val()) {
			this.$frm.find('input[name="paymentAmount"]').css("background-color","#e1ffe1");
			} else {
			this.$frm.find('input[name="paymentAmount"]').css("background-color","#ffdfdf");
			}	

			
	} else {
	this.$frm.find('input[name="merchandiseNetVn"]').val(
			germanDezimal(merchandiseNetVn.toFixed(2)));
	this.$frm.find('input[name="merchandiseNetVr"]').val(
			germanDezimal(merchandiseNetVr.toFixed(2)));
	this.$frm.find('input[name="merchandiseNetTo"]').val(
			germanDezimal((merchandiseNetVn + merchandiseNetVr).toFixed(2)));
	this.$frm.find('input[name="packageNetVn"]').val(
			germanDezimal(packageNetVn.toFixed(2)));
	this.$frm.find('input[name="packageNetVr"]').val(
			germanDezimal(packageNetVr.toFixed(2)));
	this.$frm.find('input[name="packageNetTo"]').val(
			germanDezimal((packageNetVn + packageNetVr).toFixed(2)));
	this.$frm.find('input[name="dispatchNetVn"]').val(
			germanDezimal(dispatchNetVn.toFixed(2)));
	this.$frm.find('input[name="dispatchNetVr"]').val(
			germanDezimal(dispatchNetVr.toFixed(2)));
	this.$frm.find('input[name="dispatchNetTo"]').val(
			germanDezimal((dispatchNetVn + dispatchNetVr).toFixed(2)));
	this.$frm.find('input[name="netValue"]').val(
			germanDezimal((merchandiseNetVn + merchandiseNetVr
					+ dispatchNetVn + dispatchNetVr).toFixed(2)));
	this.$frm.find('input[name="VATn"]').val(germanDezimal(VATn.toFixed(2)));
	this.$frm.find('input[name="VATr"]').val(germanDezimal(VATr.toFixed(2)));
	this.$frm.find('input[name="VATTo"]').val(
			germanDezimal((VATn + VATr).toFixed(2)));
	this.$frm.find('input[name="grossValue"]').val(
			germanDezimal(grossValue.toFixed(2)));
	this.$frm.find('input[name="tradeDiscount"]').val(
			germanDezimal(tradeDiscount.toFixed(2)));
	this.$frm.find('input[name="paymentAmount"]').val(
			germanDezimal(paymentAmount.toFixed(2)));
	}
	
	return;

}

/**
 * **** edit and save methods
 * 
 */

_ArticlePosition.prototype._savePosition = function() {
	var myClass = this;

	$frmP = $("form#" + myClass._dialogPositions);
	var positionID = this.$frmP.find('input[name="positionID"]').val();
	if (positionID == undefined) {
		alert("define positionID in html");
		return;
	}

	if (requestID != undefined)
		$frmP.find('input[name="requestID"]').val(requestID);
	var article_id = this.$frmP.find('input[name="article_id"]').val();
	if (article_id == -1) {
		var value = this.$frmP.find('input[name="article_code"]').val();

		for (var i = 0; i < this.rowsArticle.length; i++) {

			if (this.rowsArticle[i].article_code == value) {
				if (this.$frmP.find('input[name="article_id"]').val() == undefined)
					alert("define article_id as hidden field");
				this.$frmP.find('input[name="article_id"]').val(
						this.rowsArticle[i].id);
				break;
			}
		}
	}
	// enable disabled fields for serialize doesn't catch them
	// should be done by calling function

	// include unchecked checkboxes. use filter to only include unchecked boxes.
	var data = this.$frmP.serialize();

	this.$frmP.find('input[type=checkbox]').each(function() {
		if (!this.checked) {
			data += '&' + this.name + '=0';
		} else {
			data += '&' + this.name + '=1';
		}
	});

	var row = params_unserialize(data);

	var data = {
		"action" : "save",
		"data" : JSON.stringify(row)
	};

	phpModul = "../../" + this._phpSavePosition;

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {

			var array = getDataContent(data);
			myClass._rowsPositions = array["rowsPositions"];
			this._rowsPositions = array["rowsPositions"];
			myClass._trOrderPositions();
			$frmP.find('input[name="positionID"]').val(-1);
			// reset dialog position
			$frmP.find('input[name="article_code"]').val('');
			$frmP.find('input[name="name"]').val('');
			$frmP.find('select[name="variation1_id"]').find('option').remove()
					.end();
			$frmP.find('select[name="variation2_id"]').find('option').remove()
					.end();
			$frmP.find('input[name="quantity"]').val('');
			$frmP.find('input[name="quantity_unit"]').val('');
			$frmP.find('input[name="price"]').val('');
			$frmP.find('input[name="discount"]').val('');
			$frmP.find('input[name="sumPosition"]').val('');

			// disabled fields for serialize doesn't catch them
			// should be done by calling function

		} // end ajax sucess
	}) // ende ajax

	return;
}

_ArticlePosition.prototype._deletePosition = function(positionID) {
	var myClass = this;
	$frmP = $("form#" + myClass._dialogPositions);

	if (!confirm("delete position, are you sure?"))
		return;

	var data = {
		"action" : "delete",
		"positionID" : positionID,
		"table" : $frmP.find('input[name="table"]').val()
	};

	data = $.param(data);
	phpModul = "../../" + this._phpSavePosition;

	$.ajax({
		type : "POST",
		dataType : "json",
		url : phpModul,
		data : data,
		success : function(data) {

			var array = getDataContent(data);
			myClass._rowsPositions = array["rowsPositions"];
			myClass._trOrderPositions();
		} // end ajax sucess
	}) // ende ajax

	return;
}

_ArticlePosition.prototype._editPosition = function(positionID) {
	this.$frmP = $("form#" + this._dialogPositions);

	for (var i = 0; i < this._rowsPositions.length; i++) {
		row = this._rowsPositions[i];

		if (row.id == positionID) {

			this.$frmP.find('input[name="positionID"]').val(positionID);
			this.$frmP.find('input[name="article_code"]').val(row.article_code);
			this.$frmP.find('input[name="name"]').val(row.name);
			this.$frmP.find('input[name="quantity"]').val(
					germanDezimal(row.quantity));
			this.$frmP.find('input[name="quantity_unit"]').val(
					row.quantity_unit);
			this.$frmP.find('input[name="content"]').val(row.content);
			this.$frmP.find('input[name="text"]').val(row.text);
			this.$frmP.find('input[name="price"]')
					.val(germanDezimal(row.price));
			this.$frmP.find('input[name="discount"]').val(
					germanDezimal(row.discount));
			this.$frmP.find('input[name="retourCredit"]').val(
					germanDezimal(row.retourCredit));
			this.$frmP.find('input[name="weight"]').val(
					germanDezimal(row.weight));
			this.$frmP.find('input[name="sumPosition"]').val(
					germanDezimal(row.sumPosition));
			this.$frmP.find('select[name="vat_id"]').val(row.vat_id);
			this.$frmP.find('select[name="variation1_id"]').find('option')
					.remove().end();
			this.$frmP.find('select[name="variation2_id"]').find('option')
					.remove().end();
			for (var vi = 0; vi < this.rowsVariations.length; vi++) {
				if (this.rowsVariations[vi].id == row.variation1_id) {
					var variation_group_id = this.rowsVariations[vi].variation_group_id;
					for (var vii = 0; vii < this.rowsVariations.length; vii++) {
						if (this.rowsVariations[vii].variation_group_id == variation_group_id)
							this.$frmP
									.find('select[name="variation1_id"]')
									.append(
											new Option(
													this.rowsVariations[vii].name,
													this.rowsVariations[vii].id));
					}
					break;
				}
			}

			for (var vi = 0; vi < this.rowsVariations.length; vi++) {

				if (this.rowsVariations[vi].id == row.variation2_id) {
					var variation_group_id = this.rowsVariations[vi].variation_group_id;
					for (var vii = 0; vii < this.rowsVariations.length; vii++) {
						if (this.rowsVariations[vii].variation_group_id == variation_group_id)
							this.$frmP
									.find('select[name="variation2_id"]')
									.append(
											new Option(
													this.rowsVariations[vii].name,
													this.rowsVariations[vii].id));
					}
					break;
				}
			}

			this.$frmP.find('select[name="variation1_id"]').val(
					row.variation1_id);
			this.$frmP.find('select[name="variation2_id"]').val(
					row.variation2_id);

			if (row.faultID != undefined) {
				this.$frmP.find('input[name="fault"]').val(
						germanDezimal(row.fault));
				this.$frmP.find('select[name="faultID"]').val(row.faultID);
			}

			if (row.gross_weight != undefined) {
				var packageWeight = 0;
				/**
				 * change weight
				 */

				this.$frmP
						.find('input[name="weight"]')
						.change(
								function() {
									var weight = parseInt(comma2dot(this.$frmP
											.find('input[name="weight"]').val()));
									var quantity = parseInt(comma2dot(this.$frmP
											.find('input[name="quantity"]')
											.val()));

									var article_code = this.$frmP.find(
											'input[name="article_code"]').val();
									var variation1_id = this.$frmP.find(
											'select[name="variation1_id"]')
											.val();
									var variation2_id = this.$frmP.find(
											'select[name="variation2_id"]')
											.val();
									for (ii = 0; ii < rowsArticle.length; ii++) {
										if (article_code == this.rowsArticle[ii].article_code) {
											article_id = this.rowsArticle[ii].id;
											break;
										}
									}

									if (variation1_id == null)
										variation1_id = 0;
									if (variation2_id == null)
										variation2_id = 0;
									for (var i = 0; i < this.rowsSpec.length; i++) {
										if (this.rowsSpec[i].article_id == article_id
												&& this.rowsSpec[i].variation1_id == variation1_id
												&& this.rowsSpec[i].variation2_id == variation2_id) {
											packageWeight = parseInt(this.rowsSpec[i].weight);
											break;
										}
									}
									var gross_weight = quantity * packageWeight
											+ weight;
									this.$frmP.find(
											'input[name="gross_weight"]').val(
											germanDezimal(gross_weight));
								});

				this.$frmP
						.find('input[name="quantity"]')
						.change(
								function() {
									var weight = parseInt(comma2dot(this.$frmP
											.find('input[name="weight"]').val()));
									var quantity = parseInt(comma2dot(this.$frmP
											.find('input[name="quantity"]')
											.val()));
									var article_code = this.$frmP.find(
											'input[name="article_code"]').val();
									var variation1_id = this.$frmP.find(
											'select[name="variation1_id"]')
											.val();
									var variation2_id = this.$frmP.find(
											'select[name="variation2_id"]')
											.val();

									for (ii = 0; ii < this.rowsArticle.length; ii++) {
										if (article_code == this.rowsArticle[ii].article_code) {
											article_id = this.rowsArticle[ii].id;
											break;
										}
									}

									if (variation1_id == null)
										variation1_id = 0;
									if (variation2_id == null)
										variation2_id = 0;
									for (var i = 0; i < this.rowsSpec.length; i++) {

										if (this.rowsSpec[i].article_id == article_id
												&& this.rowsSpec[i].variation1_id == variation1_id
												&& this.rowsSpec[i].variation2_id == variation2_id) {
											packageWeight = parseInt(this.rowsSpec[i].weight);
											break;
										}
									}

									var gross_weight = quantity * packageWeight
											+ weight;
									this.$frmP.find(
											'input[name="gross_weight"]').val(
											germanDezimal(gross_weight));
								});

			} // gross_weight undefined

		} // position_id
	}

	return;
}