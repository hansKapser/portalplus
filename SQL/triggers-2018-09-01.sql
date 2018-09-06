-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: portal17
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                firmenOld_insert BEFORE INSERT ON firmenOld 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = firmenOld and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'firmenOld',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_insert BEFORE INSERT ON p17_article 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_update BEFORE UPDATE ON p17_article 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_datasheets_insert BEFORE INSERT ON p17_article_datasheets 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_datasheets and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_datasheets',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_datasheets_update BEFORE UPDATE ON p17_article_datasheets 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_datasheets',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_group_insert BEFORE INSERT ON p17_article_group 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_group and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_group',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_group_update BEFORE UPDATE ON p17_article_group 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_group',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_images_insert BEFORE INSERT ON p17_article_images 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_images and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_images',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_images_update BEFORE UPDATE ON p17_article_images 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_images',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_references_insert BEFORE INSERT ON p17_article_references 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_references and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_references',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_references_update BEFORE UPDATE ON p17_article_references 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_references',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_set_insert BEFORE INSERT ON p17_article_set 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_set and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_set',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_set_update BEFORE UPDATE ON p17_article_set 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_set',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_insert BEFORE INSERT ON p17_article_variation 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_variation and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_update BEFORE UPDATE ON p17_article_variation 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_group_insert BEFORE INSERT ON p17_article_variation_group 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_variation_group and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation_group',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_group_update BEFORE UPDATE ON p17_article_variation_group 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation_group',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_spec_insert BEFORE INSERT ON p17_article_variation_spec 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_article_variation_spec and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation_spec',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_article_variation_spec_update BEFORE UPDATE ON p17_article_variation_spec 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_article_variation_spec',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_bank_accounts_insert BEFORE INSERT ON p17_bank_accounts 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_bank_accounts and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_bank_accounts',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_bank_accounts_update BEFORE UPDATE ON p17_bank_accounts 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_bank_accounts',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_banks_insert BEFORE INSERT ON p17_banks 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_banks and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_banks',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_banks_update BEFORE UPDATE ON p17_banks 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_banks',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_baysped_carriage_home_insert BEFORE INSERT ON p17_baysped_carriage_home 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_baysped_carriage_home and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_baysped_carriage_home',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_baysped_freightage_insert BEFORE INSERT ON p17_baysped_freightage 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_baysped_freightage and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_baysped_freightage',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_calendar_insert BEFORE INSERT ON p17_calendar 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_calendar and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_calendar',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_calendar_update BEFORE UPDATE ON p17_calendar 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_calendar',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_calendar_categories_insert BEFORE INSERT ON p17_calendar_categories 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_calendar_categories and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_calendar_categories',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_calendar_categories_update BEFORE UPDATE ON p17_calendar_categories 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_calendar_categories',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_distances_insert BEFORE INSERT ON p17_distances 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_distances and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_distances',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_distances_update BEFORE UPDATE ON p17_distances 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_distances',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_divisions_insert BEFORE INSERT ON p17_divisions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_divisions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_divisions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_divisions_update BEFORE UPDATE ON p17_divisions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_divisions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_email_message_insert BEFORE INSERT ON p17_email_message 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_email_message and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_email_message',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_email_message_update BEFORE UPDATE ON p17_email_message 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_email_message',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `prDate` BEFORE INSERT ON `p17_exam` FOR EACH ROW BEGIN
    declare ID int (1);
    IF ID = 1 THEN
    SET NEW.examDate = NOW();
    END IF;
  END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_insert BEFORE INSERT ON p17_exam 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_update BEFORE UPDATE ON p17_exam 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_fibu_journalID_insert BEFORE INSERT ON p17_exam_fibu_journalID 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_fibu_journalID and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_fibu_journalID',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_order_purchase_insert BEFORE INSERT ON p17_exam_order_purchase 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_order_purchase and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_order_purchase',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_order_purchase_positions_insert BEFORE INSERT ON p17_exam_order_purchase_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_order_purchase_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_order_purchase_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_order_purchase_positions_update BEFORE UPDATE ON p17_exam_order_purchase_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_order_purchase_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_insert BEFORE INSERT ON p17_exam_purchase_order 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_purchase_order and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_exam_purchase_order_update` BEFORE UPDATE ON `p17_exam_purchase_order` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_delivery_positions_insert BEFORE INSERT ON p17_exam_purchase_order_delivery_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_purchase_order_delivery_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_delivery_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_delivery_positions_update BEFORE UPDATE ON p17_exam_purchase_order_delivery_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_delivery_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_invoice_insert BEFORE INSERT ON p17_exam_purchase_order_invoice 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_purchase_order_invoice and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_invoice',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_invoice_update BEFORE UPDATE ON p17_exam_purchase_order_invoice 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_invoice',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_invoice_positions_insert BEFORE INSERT ON p17_exam_purchase_order_invoice_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_purchase_order_invoice_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_invoice_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_invoice_positions_update BEFORE UPDATE ON p17_exam_purchase_order_invoice_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_invoice_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_positions_insert BEFORE INSERT ON p17_exam_purchase_order_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_exam_purchase_order_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_exam_purchase_order_positions_update BEFORE UPDATE ON p17_exam_purchase_order_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_exam_purchase_order_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fair_order_positions_insert BEFORE INSERT ON p17_fair_order_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fair_order_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fair_order_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fair_order_positions_update BEFORE UPDATE ON p17_fair_order_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fair_order_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fair_orderbook_insert BEFORE INSERT ON p17_fair_orderbook 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fair_orderbook and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fair_orderbook',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_fair_orderbook_update` BEFORE UPDATE ON `p17_fair_orderbook` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fair_orderbook',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fairs_insert BEFORE INSERT ON p17_fairs 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fairs and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fairs',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_fairs_update` BEFORE UPDATE ON `p17_fairs` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fairs',OLD.fairID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_assets_insert BEFORE INSERT ON p17_fibu_assets 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_assets and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_assets',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_assets_update BEFORE UPDATE ON p17_fibu_assets 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_assets',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_bilanzkennziffern_insert BEFORE INSERT ON p17_fibu_bilanzkennziffern 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_bilanzkennziffern and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_bilanzkennziffern',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_bilanzkennziffern_update BEFORE UPDATE ON p17_fibu_bilanzkennziffern 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_bilanzkennziffern',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_hauptbuch_insert BEFORE INSERT ON p17_fibu_hauptbuch 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_hauptbuch and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_hauptbuch',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_hauptbuch_update BEFORE UPDATE ON p17_fibu_hauptbuch 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_hauptbuch',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_journal_insert BEFORE INSERT ON p17_fibu_journal 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_journal and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_journal',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_journal_update BEFORE UPDATE ON p17_fibu_journal 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_journal',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_journalID_insert BEFORE INSERT ON p17_fibu_journalID 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_journalID and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_journalID',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_fibu_journalID_update` BEFORE UPDATE ON `p17_fibu_journalID` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_journalID',OLD.journalID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_opliste_insert BEFORE INSERT ON p17_fibu_opliste 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_opliste and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_opliste',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_opliste_update BEFORE UPDATE ON p17_fibu_opliste 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_opliste',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_personenkonten_insert BEFORE INSERT ON p17_fibu_personenkonten 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_personenkonten and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_personenkonten',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_personenkonten_update BEFORE UPDATE ON p17_fibu_personenkonten 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_personenkonten',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_sachkonten_insert BEFORE INSERT ON p17_fibu_sachkonten 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_sachkonten and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_sachkonten',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_fibu_sachkonten_update` BEFORE UPDATE ON `p17_fibu_sachkonten` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_sachkonten',OLD.ID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_fibu_sachkonten_klassen_insert BEFORE INSERT ON p17_fibu_sachkonten_klassen 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_fibu_sachkonten_klassen and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_sachkonten_klassen',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_fibu_sachkonten_klassen` BEFORE UPDATE ON `p17_fibu_sachkonten_klassen` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_fibu_sachkonten_klassen',OLD.klasse,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_files_insert BEFORE INSERT ON p17_files 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_files and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_files',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_files_update BEFORE UPDATE ON p17_files 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_files',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_files_offer_insert BEFORE INSERT ON p17_files_offer 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_files_offer and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_files_offer',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_files_offer_update BEFORE UPDATE ON p17_files_offer 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_files_offer',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_insert BEFORE INSERT ON p17_firms 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_firms_update` BEFORE UPDATE ON `p17_firms` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms',OLD.firmID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_application_insert BEFORE INSERT ON p17_firms_application 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_application and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_application',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_firms_application_update` BEFORE UPDATE ON `p17_firms_application` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms',OLD.firmID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_documents_insert BEFORE INSERT ON p17_firms_documents 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_documents and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_documents',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_documents_update BEFORE UPDATE ON p17_firms_documents 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_documents',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_documents_folder_insert BEFORE INSERT ON p17_firms_documents_folder 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_documents_folder and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_documents_folder',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_documents_folder_update BEFORE UPDATE ON p17_firms_documents_folder 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_documents_folder',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_files_insert BEFORE INSERT ON p17_firms_files 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_files and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_files',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_files_update BEFORE UPDATE ON p17_firms_files 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_files',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_numbers_insert BEFORE INSERT ON p17_firms_numbers 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_numbers and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_numbers',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_numbers_update BEFORE UPDATE ON p17_firms_numbers 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_numbers',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_products_insert BEFORE INSERT ON p17_firms_products 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_products and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_products',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_products_update BEFORE UPDATE ON p17_firms_products 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_products',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_textmodules_insert BEFORE INSERT ON p17_firms_textmodules 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_textmodules and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_textmodules',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_textmodules_update BEFORE UPDATE ON p17_firms_textmodules 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_textmodules',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_wbtime_insert BEFORE INSERT ON p17_firms_wbtime 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_firms_wbtime and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_wbtime',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_firms_wbtime_update BEFORE UPDATE ON p17_firms_wbtime 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_firms_wbtime',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_hawali_insert BEFORE INSERT ON p17_hawali 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_hawali and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_hawali',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_hawali_update BEFORE UPDATE ON p17_hawali 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_hawali',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_menu_insert BEFORE INSERT ON p17_menu 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_menu and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_menu',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_menu_update BEFORE UPDATE ON p17_menu 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_menu',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_offer_insert BEFORE INSERT ON p17_offer 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_offer and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_offer',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_offer_update BEFORE UPDATE ON p17_offer 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_offer',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_DHL_positions_insert BEFORE INSERT ON p17_order_DHL_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_DHL_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_DHL_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_DHL_positions_update BEFORE UPDATE ON p17_order_DHL_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_DHL_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_address_external_insert BEFORE INSERT ON p17_order_address_external 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_address_external and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_address_external',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_address_external_update BEFORE UPDATE ON p17_order_address_external 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_address_external',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_credit_insert BEFORE INSERT ON p17_order_credit 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_credit and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_credit',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_credit_update BEFORE UPDATE ON p17_order_credit 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_credit',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_credit_positions_insert BEFORE INSERT ON p17_order_credit_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_credit_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_credit_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_credit_positions_update BEFORE UPDATE ON p17_order_credit_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_credit_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_invoice_insert BEFORE INSERT ON p17_order_invoice 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_invoice and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_invoice',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_invoice_update BEFORE UPDATE ON p17_order_invoice 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_invoice',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_invoice_positions_insert BEFORE INSERT ON p17_order_invoice_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_invoice_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_invoice_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_invoice_positions_update BEFORE UPDATE ON p17_order_invoice_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_invoice_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_messages_insert BEFORE INSERT ON p17_order_messages 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_messages and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_messages',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_messages_update BEFORE UPDATE ON p17_order_messages 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_messages',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_package_positions_insert BEFORE INSERT ON p17_order_package_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_package_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_package_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_package_positions_update BEFORE UPDATE ON p17_order_package_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_package_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_positions_insert BEFORE INSERT ON p17_order_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_positions_update BEFORE UPDATE ON p17_order_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_positions_KK_insert BEFORE INSERT ON p17_order_positions_KK 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_order_positions_KK and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_positions_KK',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_order_positions_KK_update BEFORE UPDATE ON p17_order_positions_KK 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_order_positions_KK',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_orderbook_insert BEFORE INSERT ON p17_orderbook 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_orderbook and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_orderbook',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_orderbook_update` BEFORE UPDATE ON `p17_orderbook` FOR EACH ROW BEGIN 
				declare activity varchar(50) default 'update';
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                
                if (NEW.orderNO!=OLD.orderNo)
                then set activity=concat('orderNo: ',OLD.orderNo,"=>",NEW.orderNo);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_orderbook',OLD.orderID,activity); 
                end if;

				if (NEW.purchaseNO!=OLD.purchaseNo)
                then set activity=concat('purchaseNo: ',OLD.purchaseNo,"=>",NEW.purchaseNo);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action)
                    values 
                    (NEW.userID,'p17_orderbook',OLD.orderID,activity); 

                end if;

				if (NEW.dispatchDate!=OLD.dispatchDate)
                then set activity=concat('dispatch: ',OLD.dispatchDate,"=>",NEW.dispatchDate);
                insert into p17_user_activities 
                	(NEW.userID,p17_table,table_id,action) 
                    values
                    (NEW.userID,'p17_orderbook',OLD.orderID,activity); 
                end if;

				if (NEW.receiptDate!=OLD.receiptDate)
                then set activity=concat('receipt: ',OLD.receiptDate,"=>",NEW.receiptDate);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values
                    (NEW.userID,'p17_orderbook',OLD.orderID,activity); 
                end if;
                
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_orderbook_KK_insert BEFORE INSERT ON p17_orderbook_KK 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_orderbook_KK and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_orderbook_KK',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_orderbook_KK_update` BEFORE UPDATE ON `p17_orderbook_KK` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_orderbook',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_payfriend_journal_insert BEFORE INSERT ON p17_payfriend_journal 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_payfriend_journal and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_payfriend_journal',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_payfriend_journal_update BEFORE UPDATE ON p17_payfriend_journal 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_payfriend_journal',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_payfriend_user_insert BEFORE INSERT ON p17_payfriend_user 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_payfriend_user and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_payfriend_user',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_payfriend_user_update BEFORE UPDATE ON p17_payfriend_user 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_payfriend_user',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_pinboard_insert BEFORE INSERT ON p17_pinboard 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_pinboard and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_pinboard',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_pinboard_update BEFORE UPDATE ON p17_pinboard 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_pinboard',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_fees_insert BEFORE INSERT ON p17_post_fees 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_post_fees and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_fees',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_fees_update BEFORE UPDATE ON p17_post_fees 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_fees',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_parcel_station_insert BEFORE INSERT ON p17_post_parcel_station 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_post_parcel_station and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_parcel_station',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_parcel_station_update BEFORE UPDATE ON p17_post_parcel_station 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_parcel_station',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_user_insert BEFORE INSERT ON p17_post_user 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_post_user and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_user',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_post_user_update BEFORE UPDATE ON p17_post_user 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_post_user',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_in_insert BEFORE INSERT ON p17_postbook_in 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_postbook_in and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_in',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_in_update BEFORE UPDATE ON p17_postbook_in 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_in',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_in_vouchers_insert BEFORE INSERT ON p17_postbook_in_vouchers 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_postbook_in_vouchers and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_in_vouchers',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_in_vouchers_update BEFORE UPDATE ON p17_postbook_in_vouchers 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_in_vouchers',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_out_insert BEFORE INSERT ON p17_postbook_out 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_postbook_out and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_out',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_postbook_out_update BEFORE UPDATE ON p17_postbook_out 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_postbook_out',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_project_activities_insert BEFORE INSERT ON p17_project_activities 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_project_activities and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_project_activities',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_project_activities_update BEFORE UPDATE ON p17_project_activities 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_project_activities',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_projects_insert BEFORE INSERT ON p17_projects 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_projects and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_projects',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_projects_update` BEFORE UPDATE ON `p17_projects` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_projects',OLD.projectID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_KK_insert BEFORE INSERT ON p17_purchase_KK 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_KK and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_KK',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_purchase_KK_update` BEFORE UPDATE ON `p17_purchase_KK` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_KK',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_KK_positions_insert BEFORE INSERT ON p17_purchase_KK_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_KK_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_KK_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_KK_positions_update BEFORE UPDATE ON p17_purchase_KK_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_KK_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_address_external_insert BEFORE INSERT ON p17_purchase_address_external 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_address_external and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_address_external',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_purchase_address_external_update` BEFORE UPDATE ON `p17_purchase_address_external` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_address_external',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_credit_insert BEFORE INSERT ON p17_purchase_credit 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_credit and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_credit',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_credit_update BEFORE UPDATE ON p17_purchase_credit 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_credit',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_credit_positions_insert BEFORE INSERT ON p17_purchase_credit_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_credit_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_credit_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_credit_positions_update BEFORE UPDATE ON p17_purchase_credit_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_credit_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_enquiry_insert BEFORE INSERT ON p17_purchase_enquiry 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_enquiry and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_enquiry',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_purchase_enquiry_update` BEFORE UPDATE ON `p17_purchase_enquiry` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_orderbook',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_messages_insert BEFORE INSERT ON p17_purchase_messages 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_messages and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_messages',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_messages_update BEFORE UPDATE ON p17_purchase_messages 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_messages',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_positions_insert BEFORE INSERT ON p17_purchase_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_positions_update BEFORE UPDATE ON p17_purchase_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_request_insert BEFORE INSERT ON p17_purchase_request 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_request and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_request',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_purchase_request_update` BEFORE UPDATE ON `p17_purchase_request` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_request',OLD.orderID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_request_positions_insert BEFORE INSERT ON p17_purchase_request_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchase_request_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_request_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchase_request_positions_update BEFORE UPDATE ON p17_purchase_request_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchase_request_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_purchasebook_insert BEFORE INSERT ON p17_purchasebook 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_purchasebook and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_purchasebook',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_purchasebook_update` BEFORE UPDATE ON `p17_purchasebook` FOR EACH ROW BEGIN 
				declare activity varchar(50) default 'update';
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                
                if (NEW.confirmationDate!=OLD.confirmationDate)
                then set activity=concat('confirmation: ',OLD.confirmationDate,"=>",NEW.confirmationDate);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;

				if (NEW.incomingDate!=OLD.incomingDate)
                then set activity=concat('incomin: ',OLD.incomingDate,"=>",NEW.incomingDate);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action)
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 

                end if;

				if (NEW.receiptDate!=OLD.receiptDate)
                then set activity=concat('receipt: ',OLD.receiptDate,"=>",NEW.receiptDate);
                insert into p17_user_activities 
                	(NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;

				if (NEW.invoiceDate!=OLD.invoiceDate)
                then set activity=concat('invoice: ',OLD.invoiceDate,"=>",NEW.invoiceDate);
                insert into p17_user_activities 
                	(NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;
                
				if (NEW.reminder1sent!=OLD.reminder1sent)
                then set activity=concat('reminder1: ',OLD.reminder1sent,"=>",NEW.reminder1sent);
                insert into p17_user_activities 
                	(NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;
                
				if (NEW.reminder2sent!=OLD.reminder2sent)
                then set activity=concat('reminder2: ',OLD.reminder2sent,"=>",NEW.reminder2sent);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;
                
				if (NEW.reminder3sent!=OLD.reminder3sent)
                then set activity=concat('reminder3: ',OLD.reminder3sent,"=>",NEW.reminder3sent);
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values 
                    (NEW.userID,'p17_purchasebook',OLD.orderID,activity); 
                end if;

                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_schools_insert` BEFORE INSERT ON `p17_schools` FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_schools and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_schools',NEW.schoolNo,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_schools` BEFORE UPDATE ON `p17_schools` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_schools',OLD.schoolNo,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_shipment_positions_insert BEFORE INSERT ON p17_shipment_positions 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_shipment_positions and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_shipment_positions',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_shipment_positions_update BEFORE UPDATE ON p17_shipment_positions 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_shipment_positions',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_stock_others_insert BEFORE INSERT ON p17_stock_others 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_stock_others and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_stock_others',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_stock_others_update BEFORE UPDATE ON p17_stock_others 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_stock_others',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_stock_transaction_insert` BEFORE INSERT ON `p17_stock_transaction` FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                declare activity varchar(50) default 'insert';
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_stock_transaction and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                set activity=concat('store insert: ',NEW.transaction); 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_stock_transaction',last_id,activity); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_stock_transaction_update BEFORE UPDATE ON p17_stock_transaction 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_stock_transaction',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_system_grid_insert BEFORE INSERT ON p17_system_grid 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_system_grid and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_system_grid',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_system_grid_update BEFORE UPDATE ON p17_system_grid 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_system_grid',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_templatesPdf_insert BEFORE INSERT ON p17_templatesPdf 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_templatesPdf and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_templatesPdf',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_templatesPdf_update BEFORE UPDATE ON p17_templatesPdf 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_templatesPdf',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_templatesPdf_sic_insert BEFORE INSERT ON p17_templatesPdf_sic 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_templatesPdf_sic and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_templatesPdf_sic',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_templatesPdf_sic_update BEFORE UPDATE ON p17_templatesPdf_sic 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_templatesPdf_sic',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_terms_of_payment_insert BEFORE INSERT ON p17_terms_of_payment 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_terms_of_payment and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_terms_of_payment',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_terms_of_payment_update BEFORE UPDATE ON p17_terms_of_payment 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_terms_of_payment',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_tickets_insert BEFORE INSERT ON p17_tickets 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_tickets and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_tickets',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_tickets_update` BEFORE UPDATE ON `p17_tickets` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_tickets',OLD.ticketID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_insert BEFORE INSERT ON p17_user 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER `p17_user_update` BEFORE UPDATE ON `p17_user` FOR EACH ROW BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user',OLD.userID,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_activities_insert BEFORE INSERT ON p17_user_activities 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user_activities and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_activities',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_activities_update BEFORE UPDATE ON p17_user_activities 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_activities',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_classes_insert BEFORE INSERT ON p17_user_classes 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user_classes and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_classes',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_classes_update BEFORE UPDATE ON p17_user_classes 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_classes',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_profiles_insert BEFORE INSERT ON p17_user_profiles 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user_profiles and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_profiles',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_profiles_update BEFORE UPDATE ON p17_user_profiles 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_profiles',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_schedule_insert BEFORE INSERT ON p17_user_schedule 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user_schedule and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_schedule',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_schedule_update BEFORE UPDATE ON p17_user_schedule 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_schedule',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_team_insert BEFORE INSERT ON p17_user_team 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_user_team and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_team',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_user_team_update BEFORE UPDATE ON p17_user_team 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_user_team',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_vat_insert BEFORE INSERT ON p17_vat 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_vat and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_vat',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_vat_update BEFORE UPDATE ON p17_vat 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_vat',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_voucher_insert BEFORE INSERT ON p17_voucher 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_voucher and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_voucher',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_voucher_update BEFORE UPDATE ON p17_voucher 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_voucher',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_workflow_master_insert BEFORE INSERT ON p17_workflow_master 
                FOR EACH ROW BEGIN 
                declare last_id int default 0; 
                select auto_increment into last_id 
                    from information_schema.tables 
                    where table_name = p17_workflow_master and 
                    table_schema = database(); 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_workflow_master',last_id,'insert'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`hansk`@`localhost`*/ /*!50003 TRIGGER 
                p17_workflow_master_update BEFORE UPDATE ON p17_workflow_master 
                FOR EACH ROW 
                BEGIN 
                SET NEW.dateTime = NOW(); 
                if (NEW.userID is null) 
                then set NEW.userID=1; 
                else SET NEW.userID = @_userID; 
                end if; 
                insert into p17_user_activities 
                    (NEW.userID,p17_table,table_id,action) 
                    values (NEW.userID,'p17_workflow_master',OLD.id,'update'); 
                END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Dumping routines for database 'portal17'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-01 11:50:28
