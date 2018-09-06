





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <link rel="dns-prefetch" href="https://assets-cdn.github.com">
  <link rel="dns-prefetch" href="https://avatars0.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars1.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars2.githubusercontent.com">
  <link rel="dns-prefetch" href="https://avatars3.githubusercontent.com">
  <link rel="dns-prefetch" href="https://github-cloud.s3.amazonaws.com">
  <link rel="dns-prefetch" href="https://user-images.githubusercontent.com/">



  <link crossorigin="anonymous" media="all" integrity="sha512-Z0JAar9+DkI1NjGVdZr3GivARUgJtA0o2eHlTv7Ou2gshR5awWVf8QGsq11Ns9ZxQLEs+G5/SuARmvpOLMzulw==" rel="stylesheet" href="https://assets-cdn.github.com/assets/frameworks-95aff0b550d3fe338b645a4deebdcb1b.css" />
  <link crossorigin="anonymous" media="all" integrity="sha512-eeb0wTQqP0vhEg0FWGwR3lZqg7k8NoNJ3aJm5fyWM7vaSlm1ZgpLpIlXr0J82rnhHRYlpkDX1w034JzTj9YfJQ==" rel="stylesheet" href="https://assets-cdn.github.com/assets/github-1b92fc57a93ac751f875b024fc0646d2.css" />
  
  
  
  

  <meta name="viewport" content="width=device-width">
  
  <title>tildeio/rsvp.js: A lightweight library that provides tools for organizing asynchronous code</title>
    <meta name="description" content="A lightweight library that provides tools for organizing asynchronous code - tildeio/rsvp.js">
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
  <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
  <meta property="fb:app_id" content="1401488693436528">

    
    <meta property="og:image" content="https://avatars3.githubusercontent.com/u/1355851?s=400&amp;v=4" /><meta property="og:site_name" content="GitHub" /><meta property="og:type" content="object" /><meta property="og:title" content="tildeio/rsvp.js" /><meta property="og:url" content="https://github.com/tildeio/rsvp.js" /><meta property="og:description" content="A lightweight library that provides tools for organizing asynchronous code - tildeio/rsvp.js" />

  <link rel="assets" href="https://assets-cdn.github.com/">
  <link rel="web-socket" href="wss://live.github.com/_sockets/VjI6MzExODUzMjM0OjkzNDEyYzJmZjU4ODAzYzMyZmRmZjMzNzE4OTg1NmM5MzRjYTI0MDNhOTYwN2FhOWQyNGQ0NzdmOTMyZWU2M2Q=--e427ca528193edce8d184309b20bac8ada8483c6">
  <meta name="pjax-timeout" content="1000">
  <link rel="sudo-modal" href="/sessions/sudo_modal">
  <meta name="request-id" content="A47C:3EF8:101C037:1E0CD37:5B8BEA8B" data-pjax-transient>


  

  <meta name="selected-link" value="repo_source" data-pjax-transient>

      <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
    <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
    <meta name="google-site-verification" content="GXs5KoUUkNCoaAZn7wPN-t01Pywp9M3sEjnt_3_ZWPc">

  <meta name="octolytics-host" content="collector.githubapp.com" /><meta name="octolytics-app-id" content="github" /><meta name="octolytics-event-url" content="https://collector.githubapp.com/github-external/browser_event" /><meta name="octolytics-dimension-request_id" content="A47C:3EF8:101C037:1E0CD37:5B8BEA8B" /><meta name="octolytics-dimension-region_edge" content="iad" /><meta name="octolytics-dimension-region_render" content="iad" /><meta name="octolytics-actor-id" content="42834699" /><meta name="octolytics-actor-login" content="hansKapser" /><meta name="octolytics-actor-hash" content="a60b4fdfb71c34a4ee043e0d4a07013c71b677e1ce91f4dd497d6c4e363009b7" />
<meta name="analytics-location" content="/&lt;user-name&gt;/&lt;repo-name&gt;" data-pjax-transient="true" />



    <meta name="google-analytics" content="UA-3769691-2">

  <meta class="js-ga-set" name="userId" content="623811fca91e14b9d2db99c4b6e65cb6" %>

<meta class="js-ga-set" name="dimension1" content="Logged In">



  

      <meta name="hostname" content="github.com">
    <meta name="user-login" content="hansKapser">

      <meta name="expected-hostname" content="github.com">
    <meta name="js-proxy-site-detection-payload" content="ZGVhZTE4YTMzMzViOWU5NGJmZWJlMzdjNjM1ODIxOTQ2NGFmZTI0Nzc2YzNkYjczZjQxOGZjY2U4ZDk3ZjNiYnx7InJlbW90ZV9hZGRyZXNzIjoiODguMTMwLjAuMTkzIiwicmVxdWVzdF9pZCI6IkE0N0M6M0VGODoxMDFDMDM3OjFFMENEMzc6NUI4QkVBOEIiLCJ0aW1lc3RhbXAiOjE1MzU4OTYyMDQsImhvc3QiOiJnaXRodWIuY29tIn0=">

    <meta name="enabled-features" content="DASHBOARD_V2_LAYOUT_OPT_IN,EXPLORE_DISCOVER_REPOSITORIES,UNIVERSE_BANNER,FREE_TRIALS,MARKETPLACE_INSIGHTS,MARKETPLACE_DOCKERFILE_CI_CTA,MARKETPLACE_PLAN_RESTRICTION_EDITOR,MARKETPLACE_SEARCH,MARKETPLACE_INSIGHTS_CONVERSION_PERCENTAGES,MARKETPLACE_RETARGETING">

  <meta name="html-safe-nonce" content="d50d69606c24bee5f113538ca1b8a41334377eed">

  <meta http-equiv="x-pjax-version" content="047ccdd462e94f60c49cd5a457fc731b">
  

      <link href="https://github.com/tildeio/rsvp.js/commits/master.atom" rel="alternate" title="Recent Commits to rsvp.js:master" type="application/atom+xml">

  <meta name="go-import" content="github.com/tildeio/rsvp.js git https://github.com/tildeio/rsvp.js.git">

  <meta name="octolytics-dimension-user_id" content="1355851" /><meta name="octolytics-dimension-user_login" content="tildeio" /><meta name="octolytics-dimension-repository_id" content="6248967" /><meta name="octolytics-dimension-repository_nwo" content="tildeio/rsvp.js" /><meta name="octolytics-dimension-repository_public" content="true" /><meta name="octolytics-dimension-repository_is_fork" content="false" /><meta name="octolytics-dimension-repository_network_root_id" content="6248967" /><meta name="octolytics-dimension-repository_network_root_nwo" content="tildeio/rsvp.js" /><meta name="octolytics-dimension-repository_explore_github_marketplace_ci_cta_shown" content="false" />


    <link rel="canonical" href="https://github.com/tildeio/rsvp.js" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <link rel="mask-icon" href="https://assets-cdn.github.com/pinned-octocat.svg" color="#000000">
  <link rel="icon" type="image/x-icon" class="js-site-favicon" href="https://assets-cdn.github.com/favicon.ico">

<meta name="theme-color" content="#1e2327">



  <link rel="manifest" href="/manifest.json" crossOrigin="use-credentials">

  </head>

  <body class="logged-in env-production">
    

  <div class="position-relative js-header-wrapper ">
    <a href="#start-of-content" tabindex="1" class="p-3 bg-blue text-white show-on-focus js-skip-to-content">Skip to content</a>
    <div id="js-pjax-loader-bar" class="pjax-loader-bar"><div class="progress"></div></div>

    
    
    



        
<header class="Header  f5" role="banner">
  <div class="d-flex flex-justify-between px-3 container-lg">
    <div class="d-flex flex-justify-between ">
      <div class="">
        <a class="header-logo-invertocat" href="https://github.com/" data-hotkey="g d" aria-label="Homepage" data-ga-click="Header, go to dashboard, icon:logo">
  <svg height="32" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
</a>

      </div>

    </div>

    <div class="HeaderMenu d-flex flex-justify-between flex-auto">
      <div class="d-flex">
            <div class="">
              <div class="header-search scoped-search site-scoped-search js-site-search position-relative js-jump-to"
  role="search combobox"
  aria-owns="jump-to-results"
  aria-label="Search or jump to"
  aria-haspopup="listbox"
  aria-expanded="true"
>
  <div class="position-relative">
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="js-site-search-form" data-scope-type="Repository" data-scope-id="6248967" data-scoped-search-url="/tildeio/rsvp.js/search" data-unscoped-search-url="/search" action="/tildeio/rsvp.js/search" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
      <label class="form-control header-search-wrapper header-search-wrapper-jump-to position-relative d-flex flex-justify-between flex-items-center js-chromeless-input-container">
        <input type="text"
          class="form-control header-search-input jump-to-field js-jump-to-field js-site-search-focus js-site-search-field is-clearable"
          data-hotkey="s,/"
          name="q"
          value=""
          placeholder="Search or jump to…"
          data-unscoped-placeholder="Search or jump to…"
          data-scoped-placeholder="Search or jump to…"
          autocapitalize="off"
          aria-autocomplete="list"
          aria-controls="jump-to-results"
          data-jump-to-suggestions-path="/_graphql/GetSuggestedNavigationDestinations#csrf-token=kPErKJghqGpqhUTQoTQWEEbRwmy9TBGa0iRWxfSqC8gRdsyjEHkybOiS6UtI0PedDAn2KiTt5HlcxPj8lCyk1Q=="
          spellcheck="false"
          autocomplete="off"
          >
          <input type="hidden" class="js-site-search-type-field" name="type" >
            <img src="https://assets-cdn.github.com/images/search-shortcut-hint.svg" alt="" class="mr-2 header-search-key-slash">

            <div class="Box position-absolute overflow-hidden d-none jump-to-suggestions js-jump-to-suggestions-container">
              <ul class="d-none js-jump-to-suggestions-template-container">
                <li class="d-flex flex-justify-start flex-items-center p-0 f5 navigation-item js-navigation-item">
                  <a tabindex="-1" class="no-underline d-flex flex-auto flex-items-center p-2 jump-to-suggestions-path js-jump-to-suggestion-path js-navigation-open" href="">
                    <div class="jump-to-octicon js-jump-to-octicon mr-2 text-center d-none"></div>
                    <img class="avatar mr-2 flex-shrink-0 js-jump-to-suggestion-avatar" alt="" aria-label="Team" src="" width="28" height="28">

                    <div class="jump-to-suggestion-name js-jump-to-suggestion-name flex-auto overflow-hidden text-left no-wrap css-truncate css-truncate-target">
                    </div>

                    <div class="border rounded-1 flex-shrink-0 bg-gray px-1 text-gray-light ml-1 f6 d-none js-jump-to-badge-search">
                      <span class="js-jump-to-badge-search-text-default d-none" aria-label="in this repository">
                        In this repository
                      </span>
                      <span class="js-jump-to-badge-search-text-global d-none" aria-label="in all of GitHub">
                        All GitHub
                      </span>
                      <span aria-hidden="true" class="d-inline-block ml-1 v-align-middle">↵</span>
                    </div>

                    <div aria-hidden="true" class="border rounded-1 flex-shrink-0 bg-gray px-1 text-gray-light ml-1 f6 d-none d-on-nav-focus js-jump-to-badge-jump">
                      Jump to
                      <span class="d-inline-block ml-1 v-align-middle">↵</span>
                    </div>
                  </a>
                </li>
                <svg height="16" width="16" class="octicon octicon-repo flex-shrink-0 js-jump-to-repo-octicon-template" title="Repository" aria-label="Repository" viewBox="0 0 12 16" version="1.1" role="img"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"/></svg>
                <svg height="16" width="16" class="octicon octicon-project flex-shrink-0 js-jump-to-project-octicon-template" title="Project" aria-label="Project" viewBox="0 0 15 16" version="1.1" role="img"><path fill-rule="evenodd" d="M10 12h3V2h-3v10zm-4-2h3V2H6v8zm-4 4h3V2H2v12zm-1 1h13V1H1v14zM14 0H1a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/></svg>
                <svg height="16" width="16" class="octicon octicon-search flex-shrink-0 js-jump-to-search-octicon-template" title="Search" aria-label="Search" viewBox="0 0 16 16" version="1.1" role="img"><path fill-rule="evenodd" d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0 0 13 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 0 0 0-1.41v.01zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"/></svg>
              </ul>
              <ul class="d-none js-jump-to-no-results-template-container">
                <li class="d-flex flex-justify-center flex-items-center p-3 f5 d-none">
                  <span class="text-gray">No suggested jump to results</span>
                </li>
              </ul>

              <ul id="jump-to-results" class="js-navigation-container jump-to-suggestions-results-container js-jump-to-suggestions-results-container" >
                <li class="d-flex flex-justify-center flex-items-center p-0 f5">
                  <img src="https://assets-cdn.github.com/images/spinners/octocat-spinner-128.gif" alt="Octocat Spinner Icon" class="m-2" width="28">
                </li>
              </ul>
            </div>
      </label>
</form>  </div>
</div>

            </div>

          <ul class="d-flex pl-2 flex-items-center text-bold list-style-none" role="navigation">
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-hotkey="g p" data-ga-click="Header, click, Nav menu - item:pulls context:user" aria-label="Pull requests you created" data-selected-links="/pulls /pulls/assigned /pulls/mentioned /pulls" href="/pulls">
                Pull requests
</a>            </li>
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-hotkey="g i" data-ga-click="Header, click, Nav menu - item:issues context:user" aria-label="Issues you created" data-selected-links="/issues /issues/assigned /issues/mentioned /issues" href="/issues">
                Issues
</a>            </li>
              <li>
                <a class="js-selected-navigation-item HeaderNavlink px-2" data-ga-click="Header, click, Nav menu - item:marketplace context:user" data-octo-click="marketplace_click" data-octo-dimensions="location:nav_bar" data-selected-links=" /marketplace" href="/marketplace">
                   Marketplace
</a>              </li>
            <li>
              <a class="js-selected-navigation-item HeaderNavlink px-2" data-ga-click="Header, click, Nav menu - item:explore" data-selected-links="/explore /trending /trending/developers /integrations /integrations/feature/code /integrations/feature/collaborate /integrations/feature/ship showcases showcases_search showcases_landing /explore" href="/explore">
                Explore
</a>            </li>
          </ul>
      </div>

      <div class="d-flex">
        
<ul class="user-nav d-flex flex-items-center list-style-none" id="user-links">
  <li class="dropdown">
    <span class="d-inline-block  px-2">
      
    <a aria-label="You have no unread notifications" class="notification-indicator tooltipped tooltipped-s  js-socket-channel js-notification-indicator" data-hotkey="g n" data-ga-click="Header, go to notifications, icon:read" data-channel="notification-changed:42834699" href="/notifications">
        <span class="mail-status "></span>
        <svg class="octicon octicon-bell" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M13.99 11.991v1H0v-1l.73-.58c.769-.769.809-2.547 1.189-4.416.77-3.767 4.077-4.996 4.077-4.996 0-.55.45-1 .999-1 .55 0 1 .45 1 1 0 0 3.387 1.229 4.156 4.996.38 1.879.42 3.657 1.19 4.417l.659.58h-.01zM6.995 15.99c1.11 0 1.999-.89 1.999-1.999H4.996c0 1.11.89 1.999 1.999 1.999z"/></svg>
</a>
    </span>
  </li>

  <li class="dropdown">
    <details class="details-overlay details-reset d-flex px-2 flex-items-center">
      <summary class="HeaderNavlink"
         aria-label="Create new…"
         data-ga-click="Header, create new, icon:add">
        <svg class="octicon octicon-plus float-left mr-1 mt-1" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5v2z"/></svg>
        <span class="dropdown-caret mt-1"></span>
      </summary>
      <details-menu class="dropdown-menu dropdown-menu-sw">
        
<a role="menuitem" class="dropdown-item" href="/new" data-ga-click="Header, create new repository">
  New repository
</a>

  <a role="menuitem" class="dropdown-item" href="/new/import" data-ga-click="Header, import a repository">
    Import repository
  </a>

<a role="menuitem" class="dropdown-item" href="https://gist.github.com/" data-ga-click="Header, create new gist">
  New gist
</a>

  <a role="menuitem" class="dropdown-item" href="/organizations/new" data-ga-click="Header, create new organization">
    New organization
  </a>


  <div class="dropdown-divider"></div>
  <div class="dropdown-header">
    <span title="tildeio/rsvp.js">This repository</span>
  </div>
    <a role="menuitem" class="dropdown-item" href="/tildeio/rsvp.js/issues/new" data-ga-click="Header, create new issue">
      New issue
    </a>

      </details-menu>
    </details>
  </li>

  <li class="dropdown">

    <details class="details-overlay details-reset d-flex pl-2 flex-items-center">
      <summary class="HeaderNavlink name mt-1"
        aria-label="View profile and more"
        data-ga-click="Header, show menu, icon:avatar">
        <img alt="@hansKapser" class="avatar float-left mr-1" src="https://avatars0.githubusercontent.com/u/42834699?s=40&amp;v=4" height="20" width="20">
        <span class="dropdown-caret"></span>
      </summary>
      <details-menu class="dropdown-menu dropdown-menu-sw">
        <ul>
          <li class="header-nav-current-user css-truncate"><a role="menuitem" class="no-underline user-profile-link px-3 pt-2 pb-2 mb-n2 mt-n1 d-block" href="/hansKapser" data-ga-click="Header, go to profile, text:Signed in as">Signed in as <strong class="css-truncate-target">hansKapser</strong></a></li>
          <li class="dropdown-divider"></li>
          <li><a role="menuitem" class="dropdown-item" href="/hansKapser" data-ga-click="Header, go to profile, text:your profile">Your profile</a></li>
          <li><a role="menuitem" class="dropdown-item" href="/hansKapser?tab=repositories" data-ga-click="Header, go to repositories, text:your repositories">Your repositories</a></li>
          <li><a role="menuitem" class="dropdown-item" href="/hansKapser?tab=stars" data-ga-click="Header, go to starred repos, text:your stars">Your stars</a></li>
            <li><a role="menuitem" class="dropdown-item" href="https://gist.github.com/" data-ga-click="Header, your gists, text:your gists">Your gists</a></li>
          <li class="dropdown-divider"></li>
          <li><a role="menuitem" class="dropdown-item" href="https://help.github.com" data-ga-click="Header, go to help, text:help">Help</a></li>
          <li><a role="menuitem" class="dropdown-item" href="/settings/profile" data-ga-click="Header, go to settings, icon:settings">Settings</a></li>
          <li>
            <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="logout-form" action="/logout" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="lUZqp8W8wOYXbx/8U2G9/1RERJKtqxb7Hcp9sikojbByiw7qtf8LdkhjNKiAPNYS8+kq5OSz/ibPJbjw35X6bw==" />
              <button type="submit" class="dropdown-item dropdown-signout" data-ga-click="Header, sign out, icon:logout" role="menuitem">
                Sign out
              </button>
</form>          </li>
        </ul>
      </details-menu>
    </details>
  </li>
</ul>



        <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="sr-only right-0" action="/logout" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="NW1IOaFGkZA7krrqDJlNR9eJqIw8q48p+JnVCqqGhiXSoCx00QVaAGSekb7fxCaqcCTG+nWzZ/QqdhBIXDvx+g==" />
          <button type="submit" class="dropdown-item dropdown-signout" data-ga-click="Header, sign out, icon:logout">
            Sign out
          </button>
</form>      </div>
    </div>
  </div>
</header>

      

  </div>

  <div id="start-of-content" class="show-on-focus"></div>

    <div id="js-flash-container">


</div>



  <div role="main" class="application-main ">
        <div itemscope itemtype="http://schema.org/SoftwareSourceCode" class="">
    <div id="js-repo-pjax-container" data-pjax-container >
      



  



  <div class="pagehead repohead instapaper_ignore readability-menu experiment-repo-nav  ">
    <div class="repohead-details-container clearfix container">

      <ul class="pagehead-actions">
  <li>
        <!-- '"` --><!-- </textarea></xmp> --></option></form><form data-autosubmit="true" data-remote="true" class="js-social-container" action="/notifications/subscribe" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="NM004X2mMh7/j6ZNDrp6+2UJnrxYHKU6jsIjkLmCZIW8ERvxb6eTo07X90QHJdes9ZqgFn8ZovNVwiBdpY/hfA==" />      <input type="hidden" name="repository_id" id="repository_id" value="6248967" class="form-control" />

        <div class="select-menu js-menu-container js-select-menu">
          <a href="/tildeio/rsvp.js/subscription"
            class="btn btn-sm btn-with-count select-menu-button js-menu-target"
            role="button"
            aria-haspopup="true"
            aria-expanded="false"
            aria-label="Toggle repository notifications menu"
            data-ga-click="Repository, click Watch settings, action:files#disambiguate">
            <span class="js-select-button">
                <svg class="octicon octicon-eye v-align-text-bottom" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                Watch
            </span>
          </a>
          <a class="social-count js-social-count"
            href="/tildeio/rsvp.js/watchers"
            aria-label="112 users are watching this repository">
            112
          </a>

        <div class="select-menu-modal-holder">
          <div class="select-menu-modal subscription-menu-modal js-menu-content">
            <div class="select-menu-header js-navigation-enable" tabindex="-1">
              <svg class="octicon octicon-x js-menu-close" role="img" aria-label="Close" viewBox="0 0 12 16" version="1.1" width="12" height="16"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg>
              <span class="select-menu-title">Notifications</span>
            </div>

              <div class="select-menu-list js-navigation-container" role="menu">

                <div class="select-menu-item js-navigation-item selected" role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_included" value="included" checked="checked" />
                    <span class="select-menu-item-heading">Not watching</span>
                    <span class="description">Be notified when participating or @mentioned.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-eye v-align-text-bottom" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                      Watch
                    </span>
                  </div>
                </div>

                <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_subscribed" value="subscribed" />
                    <span class="select-menu-item-heading">Watching</span>
                    <span class="description">Be notified of all conversations.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-eye v-align-text-bottom" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.06 2C3 2 0 8 0 8s3 6 8.06 6C13 14 16 8 16 8s-3-6-7.94-6zM8 12c-2.2 0-4-1.78-4-4 0-2.2 1.8-4 4-4 2.22 0 4 1.8 4 4 0 2.22-1.78 4-4 4zm2-4c0 1.11-.89 2-2 2-1.11 0-2-.89-2-2 0-1.11.89-2 2-2 1.11 0 2 .89 2 2z"/></svg>
                        Unwatch
                    </span>
                  </div>
                </div>

                <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                  <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
                  <div class="select-menu-item-text">
                    <input type="radio" name="do" id="do_ignore" value="ignore" />
                    <span class="select-menu-item-heading">Ignoring</span>
                    <span class="description">Never be notified.</span>
                    <span class="js-select-button-text hidden-select-button-text">
                      <svg class="octicon octicon-mute v-align-text-bottom" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 2.81v10.38c0 .67-.81 1-1.28.53L3 10H1c-.55 0-1-.45-1-1V7c0-.55.45-1 1-1h2l3.72-3.72C7.19 1.81 8 2.14 8 2.81zm7.53 3.22l-1.06-1.06-1.97 1.97-1.97-1.97-1.06 1.06L11.44 8 9.47 9.97l1.06 1.06 1.97-1.97 1.97 1.97 1.06-1.06L13.56 8l1.97-1.97z"/></svg>
                        Stop ignoring
                    </span>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
</form>
  </li>

  <li>
    
  <div class="js-toggler-container js-social-container starring-container ">
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="starred js-social-form" action="/tildeio/rsvp.js/unstar" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="xgrb4Mmi7Vp7bpLX2srP2Jakn4+55eVbu4ipZ6UH6sMnKP85u00Fub1ewcHJt68x7A5gA3l0lFvkeoT9HC5TOA==" />
      <input type="hidden" name="context" value="repository"></input>
      <button
        type="submit"
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Unstar this repository" title="Unstar tildeio/rsvp.js"
        data-ga-click="Repository, click unstar button, action:files#disambiguate; text:Unstar">
        <svg class="octicon octicon-star v-align-text-bottom" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"/></svg>
        Unstar
      </button>
        <a class="social-count js-social-count" href="/tildeio/rsvp.js/stargazers"
           aria-label="3499 users starred this repository">
          3,499
        </a>
</form>
    <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="unstarred js-social-form" action="/tildeio/rsvp.js/star" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="7X6e6wD0Z4fyncOF5Gk3amfueRGpHrpZayojoRlrtvFtZDq2DgWeIswW5vF8VpBqKkavRXPqfRSbTvq5QXCZIw==" />
      <input type="hidden" name="context" value="repository"></input>
      <button
        type="submit"
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Star this repository" title="Star tildeio/rsvp.js"
        data-ga-click="Repository, click star button, action:files#disambiguate; text:Star">
        <svg class="octicon octicon-star v-align-text-bottom" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74L14 6z"/></svg>
        Star
      </button>
        <a class="social-count js-social-count" href="/tildeio/rsvp.js/stargazers"
           aria-label="3499 users starred this repository">
          3,499
        </a>
</form>  </div>

  </li>

  <li>
          <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="btn-with-count" action="/tildeio/rsvp.js/fork" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="kTRB4afnFdt0uNI/LU7oRVokAI98c4glPNxKVcRRMckr6IuHI9xTYpB/KJyFIU+jkBWJvIAGeG0K3JEZbt3TpQ==" />
            <button
                type="submit"
                class="btn btn-sm btn-with-count"
                data-ga-click="Repository, show fork modal, action:files#disambiguate; text:Fork"
                title="Fork your own copy of tildeio/rsvp.js to your account"
                aria-label="Fork your own copy of tildeio/rsvp.js to your account">
              <svg class="octicon octicon-repo-forked v-align-text-bottom" viewBox="0 0 10 16" version="1.1" width="10" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 1a1.993 1.993 0 0 0-1 3.72V6L5 8 3 6V4.72A1.993 1.993 0 0 0 2 1a1.993 1.993 0 0 0-1 3.72V6.5l3 3v1.78A1.993 1.993 0 0 0 5 15a1.993 1.993 0 0 0 1-3.72V9.5l3-3V4.72A1.993 1.993 0 0 0 8 1zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3 10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm3-10c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
              Fork
            </button>
</form>
    <a href="/tildeio/rsvp.js/network/members" class="social-count"
       aria-label="267 users forked this repository">
      267
    </a>
  </li>
</ul>

      <h1 class="public ">
  <svg class="octicon octicon-repo" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9H3V8h1v1zm0-3H3v1h1V6zm0-2H3v1h1V4zm0-2H3v1h1V2zm8-1v12c0 .55-.45 1-1 1H6v2l-1.5-1.5L3 16v-2H1c-.55 0-1-.45-1-1V1c0-.55.45-1 1-1h10c.55 0 1 .45 1 1zm-1 10H1v2h2v-1h3v1h5v-2zm0-10H2v9h9V1z"/></svg>
  <span class="author" itemprop="author"><a class="url fn" rel="author" href="/tildeio">tildeio</a></span><!--
--><span class="path-divider">/</span><!--
--><strong itemprop="name"><a data-pjax="#js-repo-pjax-container" href="/tildeio/rsvp.js">rsvp.js</a></strong>

</h1>

    </div>
    
<nav class="reponav js-repo-nav js-sidenav-container-pjax container"
     itemscope
     itemtype="http://schema.org/BreadcrumbList"
     role="navigation"
     data-pjax="#js-repo-pjax-container">

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a class="js-selected-navigation-item selected reponav-item" itemprop="url" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches repo_packages /tildeio/rsvp.js" href="/tildeio/rsvp.js">
      <svg class="octicon octicon-code" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M9.5 3L8 4.5 11.5 8 8 11.5 9.5 13 14 8 9.5 3zm-5 0L0 8l4.5 5L6 11.5 2.5 8 6 4.5 4.5 3z"/></svg>
      <span itemprop="name">Code</span>
      <meta itemprop="position" content="1">
</a>  </span>

    <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
      <a itemprop="url" data-hotkey="g i" class="js-selected-navigation-item reponav-item" data-selected-links="repo_issues repo_labels repo_milestones /tildeio/rsvp.js/issues" href="/tildeio/rsvp.js/issues">
        <svg class="octicon octicon-issue-opened" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm1 3H6v5h2V4zm0 6H6v2h2v-2z"/></svg>
        <span itemprop="name">Issues</span>
        <span class="Counter">10</span>
        <meta itemprop="position" content="2">
</a>    </span>

  <span itemscope itemtype="http://schema.org/ListItem" itemprop="itemListElement">
    <a data-hotkey="g p" itemprop="url" class="js-selected-navigation-item reponav-item" data-selected-links="repo_pulls checks /tildeio/rsvp.js/pulls" href="/tildeio/rsvp.js/pulls">
      <svg class="octicon octicon-git-pull-request" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M11 11.28V5c-.03-.78-.34-1.47-.94-2.06C9.46 2.35 8.78 2.03 8 2H7V0L4 3l3 3V4h1c.27.02.48.11.69.31.21.2.3.42.31.69v6.28A1.993 1.993 0 0 0 10 15a1.993 1.993 0 0 0 1-3.72zm-1 2.92c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zM4 3c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v6.56A1.993 1.993 0 0 0 2 15a1.993 1.993 0 0 0 1-3.72V4.72c.59-.34 1-.98 1-1.72zm-.8 10c0 .66-.55 1.2-1.2 1.2-.65 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2zM2 4.2C1.34 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
      <span itemprop="name">Pull requests</span>
      <span class="Counter">5</span>
      <meta itemprop="position" content="3">
</a>  </span>

    <a data-hotkey="g b" class="js-selected-navigation-item reponav-item" data-selected-links="repo_projects new_repo_project repo_project /tildeio/rsvp.js/projects" href="/tildeio/rsvp.js/projects">
      <svg class="octicon octicon-project" viewBox="0 0 15 16" version="1.1" width="15" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M10 12h3V2h-3v10zm-4-2h3V2H6v8zm-4 4h3V2H2v12zm-1 1h13V1H1v14zM14 0H1a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z"/></svg>
      Projects
      <span class="Counter" >0</span>
</a>

    <a class="js-selected-navigation-item reponav-item" data-hotkey="g w" data-selected-links="repo_wiki /tildeio/rsvp.js/wiki" href="/tildeio/rsvp.js/wiki">
      <svg class="octicon octicon-book" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3 5h4v1H3V5zm0 3h4V7H3v1zm0 2h4V9H3v1zm11-5h-4v1h4V5zm0 2h-4v1h4V7zm0 2h-4v1h4V9zm2-6v9c0 .55-.45 1-1 1H9.5l-1 1-1-1H2c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1h5.5l1 1 1-1H15c.55 0 1 .45 1 1zm-8 .5L7.5 3H2v9h6V3.5zm7-.5H9.5l-.5.5V12h6V3z"/></svg>
      Wiki
</a>

  <a class="js-selected-navigation-item reponav-item" data-selected-links="repo_graphs repo_contributors dependency_graph pulse /tildeio/rsvp.js/pulse" href="/tildeio/rsvp.js/pulse">
    <svg class="octicon octicon-graph" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16 14v1H0V0h1v14h15zM5 13H3V8h2v5zm4 0H7V3h2v10zm4 0h-2V6h2v7z"/></svg>
    Insights
</a>

</nav>


  </div>

<div class="container new-discussion-timeline experiment-repo-nav  ">
  <div class="repository-content ">

    
  

  <div class="js-repo-meta-container">
  <div class="repository-meta mb-0 mb-3 js-repo-meta-edit js-details-container ">
    <div class="repository-meta-content col-11 mb-1">
          <span class="col-11 text-gray-dark mr-2" itemprop="about">
            A lightweight library that provides tools for organizing asynchronous code
          </span>
    </div>

  </div>

</div>



  <div class="overall-summary overall-summary-bottomless">
    <div class="stats-switcher-viewport js-stats-switcher-viewport">
      <div class="stats-switcher-wrapper">
      <ul class="numbers-summary">
        <li class="commits">
          <a data-pjax href="/tildeio/rsvp.js/commits/master">
              <svg class="octicon octicon-history" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 13H6V6h5v2H8v5zM7 1C4.81 1 2.87 2.02 1.59 3.59L0 2v4h4L2.5 4.5C3.55 3.17 5.17 2.3 7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-.34.03-.67.09-1H.08C.03 7.33 0 7.66 0 8c0 3.86 3.14 7 7 7s7-3.14 7-7-3.14-7-7-7z"/></svg>
              <span class="num text-emphasized">
                987
              </span>
              commits
          </a>
        </li>
        <li>
          <a data-pjax href="/tildeio/rsvp.js/branches">
            <svg class="octicon octicon-git-branch" viewBox="0 0 10 16" version="1.1" width="10" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M10 5c0-1.11-.89-2-2-2a1.993 1.993 0 0 0-1 3.72v.3c-.02.52-.23.98-.63 1.38-.4.4-.86.61-1.38.63-.83.02-1.48.16-2 .45V4.72a1.993 1.993 0 0 0-1-3.72C.88 1 0 1.89 0 3a2 2 0 0 0 1 1.72v6.56c-.59.35-1 .99-1 1.72 0 1.11.89 2 2 2 1.11 0 2-.89 2-2 0-.53-.2-1-.53-1.36.09-.06.48-.41.59-.47.25-.11.56-.17.94-.17 1.05-.05 1.95-.45 2.75-1.25S8.95 7.77 9 6.73h-.02C9.59 6.37 10 5.73 10 5zM2 1.8c.66 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2C1.35 4.2.8 3.65.8 3c0-.65.55-1.2 1.2-1.2zm0 12.41c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2zm6-8c-.66 0-1.2-.55-1.2-1.2 0-.65.55-1.2 1.2-1.2.65 0 1.2.55 1.2 1.2 0 .65-.55 1.2-1.2 1.2z"/></svg>
            <span class="num text-emphasized">
              3
            </span>
            branches
          </a>
        </li>

        <li>
          <a href="/tildeio/rsvp.js/releases">
            <svg class="octicon octicon-tag" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.685 1.72a2.49 2.49 0 0 0-1.76-.726H3.48A2.5 2.5 0 0 0 .994 3.48v2.456c0 .656.269 1.292.726 1.76l6.024 6.024a.99.99 0 0 0 1.402 0l4.563-4.563a.99.99 0 0 0 0-1.402L7.685 1.72zM2.366 7.048A1.54 1.54 0 0 1 1.9 5.925V3.48c0-.874.716-1.58 1.58-1.58h2.456c.418 0 .825.159 1.123.467l6.104 6.094-4.702 4.702-6.094-6.114zm.626-4.066h1.989v1.989H2.982V2.982h.01z"/></svg>
            <span class="num text-emphasized">
              50
            </span>
            releases
          </a>
        </li>

        <li>
            <include-fragment src="/tildeio/rsvp.js/contributors_size">
              <a href="/tildeio/rsvp.js/graphs/contributors">
                <svg class="octicon octicon-organization" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M16 12.999c0 .439-.45 1-1 1H7.995c-.539 0-.994-.447-.995-.999H1c-.54 0-1-.561-1-1 0-2.634 3-4 3-4s.229-.409 0-1c-.841-.621-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.442.58 2.5 3c.058 2.41-.159 2.379-1 3-.229.59 0 1 0 1s1.549.711 2.42 2.088C9.196 9.369 10 8.999 10 8.999s.229-.409 0-1c-.841-.62-1.058-.59-1-3 .058-2.419 1.367-3 2.5-3s2.437.581 2.495 3c.059 2.41-.158 2.38-1 3-.229.59 0 1 0 1s3.005 1.366 3.005 4z"/></svg>
                <span class="num text-emphasized"></span>
                Fetching contributors
              </a>
</include-fragment>        </li>
          <li>
            <a href="/tildeio/rsvp.js/blob/master/LICENSE">
              <svg class="octicon octicon-law" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7 4c-.83 0-1.5-.67-1.5-1.5S6.17 1 7 1s1.5.67 1.5 1.5S7.83 4 7 4zm7 6c0 1.11-.89 2-2 2h-1c-1.11 0-2-.89-2-2l2-4h-1c-.55 0-1-.45-1-1H8v8c.42 0 1 .45 1 1h1c.42 0 1 .45 1 1H3c0-.55.58-1 1-1h1c0-.55.58-1 1-1h.03L6 5H5c0 .55-.45 1-1 1H3l2 4c0 1.11-.89 2-2 2H2c-1.11 0-2-.89-2-2l2-4H1V5h3c0-.55.45-1 1-1h4c.55 0 1 .45 1 1h3v1h-1l2 4zM2.5 7L1 10h3L2.5 7zM13 10l-1.5-3-1.5 3h3z"/></svg>
                MIT
            </a>
          </li>
      </ul>

        <div class="repository-lang-stats">
          <ol class="repository-lang-stats-numbers">
            <li>
                <a href="/tildeio/rsvp.js/search?l=javascript"  data-ga-click="Repository, language stats search click, location:repo overview">
                  <span class="color-block language-color" style="background-color:#f1e05a;"></span>
                  <span class="lang">JavaScript</span>
                  <span class="percent">99.7%</span>
                </a>
            </li>
            <li>
                <a href="/tildeio/rsvp.js/search?l=html"  data-ga-click="Repository, language stats search click, location:repo overview">
                  <span class="color-block language-color" style="background-color:#e34c26;"></span>
                  <span class="lang">HTML</span>
                  <span class="percent">0.3%</span>
                </a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

    <button type="button" class="d-flex p-0 repository-lang-stats-graph js-toggle-lang-stats" title="Click for language details" data-ga-click="Repository, language bar stats toggle, location:repo overview">
      <span class="language-color" aria-label="JavaScript 99.7%" style="width:99.7%; background-color:#f1e05a;" itemprop="keywords">JavaScript</span>
      <span class="language-color" aria-label="HTML 0.3%" style="width:0.3%; background-color:#e34c26;" itemprop="keywords">HTML</span>
  </button>



    <div class="mt-2">
      <include-fragment src="/tildeio/rsvp.js/show_partial?partial=tree%2Frecently_touched_branches_list"></include-fragment>
    </div>

  <div class="file-navigation in-mid-page d-flex flex-items-start">
  
<div class="select-menu branch-select-menu js-menu-container js-select-menu float-left">
  <button class=" btn btn-sm select-menu-button js-menu-target css-truncate" data-hotkey="w"
    
    type="button" aria-label="Switch branches or tags" aria-expanded="false" aria-haspopup="true">
      <i>Branch:</i>
      <span class="js-select-button css-truncate-target">master</span>
  </button>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax>

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <svg class="octicon octicon-x js-menu-close" role="img" aria-label="Close" viewBox="0 0 12 16" version="1.1" width="12" height="16"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg>
        <span class="select-menu-title">Switch branches/tags</span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="form-control js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab" role="tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab" role="tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches" role="menu">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/tildeio/rsvp.js/tree/cycle-compliance"
               data-name="cycle-compliance"
               data-skip-pjax="true"
               rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                cycle-compliance
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/tildeio/rsvp.js/tree/gh-pages"
               data-name="gh-pages"
               data-skip-pjax="true"
               rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                gh-pages
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/tildeio/rsvp.js/tree/master"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target js-select-menu-filter-text">
                master
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.8.3"
              data-name="v4.8.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.8.3">
                v4.8.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.8.2"
              data-name="v4.8.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.8.2">
                v4.8.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.8.1"
              data-name="v4.8.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.8.1">
                v4.8.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.8.0"
              data-name="v4.8.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.8.0">
                v4.8.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.7.0"
              data-name="v4.7.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.7.0">
                v4.7.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.6.1"
              data-name="v4.6.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.6.1">
                v4.6.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.0.2"
              data-name="v4.0.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.0.2">
                v4.0.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.0.1"
              data-name="v4.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.0.1">
                v4.0.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v4.0.0"
              data-name="v4.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v4.0.0">
                v4.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.6.2"
              data-name="v3.6.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.6.2">
                v3.6.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.6.1"
              data-name="v3.6.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.6.1">
                v3.6.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.6.0"
              data-name="v3.6.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.6.0">
                v3.6.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.5.0"
              data-name="v3.5.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.5.0">
                v3.5.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.4.0"
              data-name="v3.4.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.4.0">
                v3.4.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.3.3"
              data-name="v3.3.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.3.3">
                v3.3.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.3.2"
              data-name="v3.3.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.3.2">
                v3.3.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.3.1"
              data-name="v3.3.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.3.1">
                v3.3.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.3.0"
              data-name="v3.3.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.3.0">
                v3.3.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.2.1"
              data-name="v3.2.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.2.1">
                v3.2.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.2.0"
              data-name="v3.2.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.2.0">
                v3.2.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.1.0"
              data-name="v3.1.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.1.0">
                v3.1.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.0.21"
              data-name="v3.0.21"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.0.21">
                v3.0.21
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.0.20"
              data-name="v3.0.20"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.0.20">
                v3.0.20
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.0.19"
              data-name="v3.0.19"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.0.19">
                v3.0.19
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.0.14"
              data-name="v3.0.14"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.0.14">
                v3.0.14
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/v3.0.11"
              data-name="v3.0.11"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="v3.0.11">
                v3.0.11
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.21"
              data-name="3.0.21"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.21">
                3.0.21
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.20"
              data-name="3.0.20"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.20">
                3.0.20
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.18"
              data-name="3.0.18"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.18">
                3.0.18
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.17"
              data-name="3.0.17"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.17">
                3.0.17
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.16"
              data-name="3.0.16"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.16">
                3.0.16
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.15"
              data-name="3.0.15"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.15">
                3.0.15
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.13"
              data-name="3.0.13"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.13">
                3.0.13
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.12"
              data-name="3.0.12"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.12">
                3.0.12
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.8"
              data-name="3.0.8"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.8">
                3.0.8
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.7"
              data-name="3.0.7"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.7">
                3.0.7
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.6"
              data-name="3.0.6"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.6">
                3.0.6
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.5"
              data-name="3.0.5"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.5">
                3.0.5
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.4"
              data-name="3.0.4"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.4">
                3.0.4
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.3"
              data-name="3.0.3"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.3">
                3.0.3
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.2"
              data-name="3.0.2"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.2">
                3.0.2
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.1"
              data-name="3.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.1">
                3.0.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/3.0.0"
              data-name="3.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="3.0.0">
                3.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/2.0.1"
              data-name="2.0.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="2.0.1">
                2.0.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/2.0.0"
              data-name="2.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="2.0.0">
                2.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/1.2.0"
              data-name="1.2.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.2.0">
                1.2.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/1.1.1"
              data-name="1.1.1"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.1.1">
                1.1.1
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/1.1.0"
              data-name="1.1.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.1.0">
                1.1.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/1.0.0"
              data-name="1.0.0"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="1.0.0">
                1.0.0
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
              href="/tildeio/rsvp.js/tree/0.3.16"
              data-name="0.3.16"
              data-skip-pjax="true"
              rel="nofollow">
              <svg class="octicon octicon-check select-menu-item-icon" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z"/></svg>
              <span class="select-menu-item-text css-truncate-target" title="0.3.16">
                0.3.16
              </span>
            </a>
        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>


        <a href="/tildeio/rsvp.js/pull/new/master" class="btn btn-sm new-pull-request-btn" data-pjax data-ga-click="Repository, new pull request, location:repo overview">
          New pull request
        </a>

  <div class="breadcrumb flex-auto">
    
  </div>

  <div class="BtnGroup">
      
  <!-- '"` --><!-- </textarea></xmp> --></option></form><form class="BtnGroup-form" action="/tildeio/rsvp.js/new/master" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="o1VaeICsjhhu0QUmECw+cGx6FiDjnAwpBDR27B/S4d5bWhRdiS0FNnDp/iweytHtom0CFmyii3mJJ78YGoU+kQ==" />
    <button class="btn btn-sm BtnGroup-item" type="submit" data-disable-with="Creating file…">
      Create new file
    </button>
</form>

      
  <a href="/tildeio/rsvp.js/upload/master" class="btn btn-sm BtnGroup-item">
    Upload files
  </a>


    <a href="/tildeio/rsvp.js/find/master"
      class="btn btn-sm empty-icon float-right BtnGroup-item"
      data-pjax
      data-hotkey="t"
      data-ga-click="Repository, find file, location:repo overview">
      Find file
    </a>
  </div>
  

    <details class="get-repo-select-menu js-get-repo-select-menu position-relative details-overlay details-reset">
  <summary class="btn btn-sm btn-primary">
    Clone or download
    <span class="dropdown-caret"></span>
  </summary>
  <div class="position-relative">
    <div class="get-repo-modal dropdown-menu dropdown-menu-sw pb-0 js-toggler-container  js-get-repo-modal">

      <div class="get-repo-modal-options">
          <div class="clone-options https-clone-options">
              <!-- '"` --><!-- </textarea></xmp> --></option></form><form data-remote="true" action="/users/set_protocol?protocol_selector=ssh&amp;protocol_type=clone" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="XQE+sI1VtRAJ8Vf7lYeFgunD4e9S2LLNUyxHtjIORAarNwNjeGwnL0rMymZuaEtn6S+miV24VLlKkrwlv4E9YQ==" /><button type="submit" class="btn-link btn-change-protocol js-toggler-target float-right">Use SSH</button></form>

            <h4 class="mb-1">
              Clone with HTTPS
              <a class="muted-link" href="https://help.github.com/articles/which-remote-url-should-i-use" target="_blank" title="Which remote URL should I use?">
                <svg class="octicon octicon-question" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 10h2v2H6v-2zm4-3.5C10 8.64 8 9 8 9H6c0-.55.45-1 1-1h.5c.28 0 .5-.22.5-.5v-1c0-.28-.22-.5-.5-.5h-1c-.28 0-.5.22-.5.5V7H4c0-1.5 1.5-3 3-3s3 1 3 2.5zM7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7z"/></svg>
              </a>
            </h4>
            <p class="mb-2 get-repo-decription-text">
              Use Git or checkout with SVN using the web URL.
            </p>

            <div class="input-group">
  <input type="text" class="form-control input-monospace input-sm" data-autoselect value="https://github.com/tildeio/rsvp.js.git" aria-label="Clone this repository at https://github.com/tildeio/rsvp.js.git" readonly>
  <div class="input-group-button">
    <clipboard-copy value="https://github.com/tildeio/rsvp.js.git" aria-label="Copy to clipboard" class="btn btn-sm">
      <svg class="octicon octicon-clippy" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M2 13h4v1H2v-1zm5-6H2v1h5V7zm2 3V8l-3 3 3 3v-2h5v-2H9zM4.5 9H2v1h2.5V9zM2 12h2.5v-1H2v1zm9 1h1v2c-.02.28-.11.52-.3.7-.19.18-.42.28-.7.3H1c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h3c0-1.11.89-2 2-2 1.11 0 2 .89 2 2h3c.55 0 1 .45 1 1v5h-1V6H1v9h10v-2zM2 5h8c0-.55-.45-1-1-1H8c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1H3c-.55 0-1 .45-1 1z"/></svg>
    </clipboard-copy>
  </div>
</div>

          </div>

          <div class="clone-options ssh-clone-options">
              <!-- '"` --><!-- </textarea></xmp> --></option></form><form data-remote="true" action="/users/set_protocol?protocol_selector=https&amp;protocol_type=clone" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="bQIoiFMNMGkxEf1dMCSMRFOuFrno2pwe/zhq0qeChLubNBVbpjSiVnIsYMDLy0KhU0JR3+e6emrmhpFBKg393A==" /><button type="submit" class="btn-link btn-change-protocol js-toggler-target float-right">Use HTTPS</button></form>

              <h4 class="mb-1">
                Clone with SSH
                <a class="muted-link" href="https://help.github.com/articles/which-remote-url-should-i-use" target="_blank" title="Which remote URL should I use?">
                  <svg class="octicon octicon-question" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 10h2v2H6v-2zm4-3.5C10 8.64 8 9 8 9H6c0-.55.45-1 1-1h.5c.28 0 .5-.22.5-.5v-1c0-.28-.22-.5-.5-.5h-1c-.28 0-.5.22-.5.5V7H4c0-1.5 1.5-3 3-3s3 1 3 2.5zM7 2.3c3.14 0 5.7 2.56 5.7 5.7s-2.56 5.7-5.7 5.7A5.71 5.71 0 0 1 1.3 8c0-3.14 2.56-5.7 5.7-5.7zM7 1C3.14 1 0 4.14 0 8s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7z"/></svg>
                </a>
              </h4>
              <p class="mb-2 get-repo-decription-text">
                Use an SSH key and passphrase from account.
              </p>

              <div class="input-group">
  <input type="text" class="form-control input-monospace input-sm" data-autoselect value="git@github.com:tildeio/rsvp.js.git" aria-label="Clone this repository at git@github.com:tildeio/rsvp.js.git" readonly>
  <div class="input-group-button">
    <clipboard-copy value="git@github.com:tildeio/rsvp.js.git" aria-label="Copy to clipboard" class="btn btn-sm">
      <svg class="octicon octicon-clippy" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M2 13h4v1H2v-1zm5-6H2v1h5V7zm2 3V8l-3 3 3 3v-2h5v-2H9zM4.5 9H2v1h2.5V9zM2 12h2.5v-1H2v1zm9 1h1v2c-.02.28-.11.52-.3.7-.19.18-.42.28-.7.3H1c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h3c0-1.11.89-2 2-2 1.11 0 2 .89 2 2h3c.55 0 1 .45 1 1v5h-1V6H1v9h10v-2zM2 5h8c0-.55-.45-1-1-1H8c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1H3c-.55 0-1 .45-1 1z"/></svg>
    </clipboard-copy>
  </div>
</div>

          </div>
        <div class="mt-2">
          
<a href="/tildeio/rsvp.js/archive/master.zip"
   class="btn btn-outline get-repo-btn
"
   rel="nofollow"
   data-ga-click="Repository, download zip, location:repo overview">
  Download ZIP
</a>

        </div>
      </div>

      <div class="js-modal-download-mac py-2 px-3 d-none">
        <h4 class="lh-condensed mb-3">Launching GitHub Desktop<span class="animated-ellipsis-container"><span class="animated-ellipsis">...</span></span></h4>
        <p class="text-gray">If nothing happens, <a href="https://desktop.github.com/">download GitHub Desktop</a> and try again.</p>
        <p><button class="btn-link js-get-repo-modal-download-back">Go back</button></p>
      </div>

      <div class="js-modal-download-windows py-2 px-3 d-none">
        <h4 class="lh-condensed mb-3">Launching GitHub Desktop<span class="animated-ellipsis-container"><span class="animated-ellipsis">...</span></span></h4>
        <p class="text-gray">If nothing happens, <a href="https://desktop.github.com/">download GitHub Desktop</a> and try again.</p>
        <p><button class="btn-link js-get-repo-modal-download-back">Go back</button></p>
      </div>

      <div class="js-modal-download-xcode py-2 px-3 d-none">
        <h4 class="lh-condensed mb-3">Launching Xcode<span class="animated-ellipsis-container"><span class="animated-ellipsis">...</span></span></h4>
        <p class="text-gray">If nothing happens, <a href="https://developer.apple.com/xcode/">download Xcode</a> and try again.</p>
        <p><button class="btn-link js-get-repo-modal-download-back">Go back</button></p>
      </div>

      <div class="js-modal-download-visual-studio py-2 px-3 d-none">
        <h4 class="lh-condensed mb-3">Launching Visual Studio<span class="animated-ellipsis-container"><span class="animated-ellipsis">...</span></span></h4>
        <p class="text-gray">If nothing happens, <a href="https://visualstudio.github.com/">download the GitHub extension for Visual Studio</a> and try again.</p>
        <p><button class="btn-link js-get-repo-modal-download-back">Go back</button></p>
      </div>

    </div>
  </div>
</details>

</div>


  

<include-fragment src="/tildeio/rsvp.js/tree-commit/1ba4bf7837ab2470b0c5f1b596c4ca172ba23c95" class="commit-tease commit-loader">
  <div class="blank loader-loading">
      <img alt="" class="loader" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32-EAF2F5.gif" width="16" height="16" />
      Fetching latest commit…
  </div>
  <div class="loader-error">
    Cannot retrieve the latest commit at this time.
  </div>
</include-fragment>



<div class="file-wrap">
  <a class="d-none js-permalink-shortcut" data-hotkey="y" href="/tildeio/rsvp.js/tree/1ba4bf7837ab2470b0c5f1b596c4ca172ba23c95">Permalink</a>

  <table class="files js-navigation-container js-active-navigation-container" data-pjax>


    <tbody>
      <tr class="warning include-fragment-error">
        <td class="icon"><svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.893 1.5c-.183-.31-.52-.5-.887-.5s-.703.19-.886.5L.138 13.499a.98.98 0 0 0 0 1.001c.193.31.53.501.886.501h13.964c.367 0 .704-.19.877-.5a1.03 1.03 0 0 0 .01-1.002L8.893 1.5zm.133 11.497H6.987v-2.003h2.039v2.003zm0-3.004H6.987V5.987h2.039v4.006z"/></svg></td>
        <td class="content" colspan="3">Failed to load latest commit information.</td>
      </tr>

        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file-directory" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M13 4H7V3c0-.66-.31-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V5c0-.55-.45-1-1-1zM6 4H1V3h5v1z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="config" id="2245023265ae4cf87d02c8b6ba991139-5288d87c55f1ecde7bab0473e64de326843b6abb" href="/tildeio/rsvp.js/tree/master/config">config</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="Remove bower stuff (we use npm and jsdelivr.com)

* misc readme cleanup" class="message" href="/tildeio/rsvp.js/commit/94d423b86ec78798cc1707705b10067ca447213d">Remove bower stuff (we use npm and jsdelivr.com)</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2017-12-27T19:30:01Z">Dec 27, 2017</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file-directory" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M13 4H7V3c0-.66-.31-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V5c0-.55-.45-1-1-1zM6 4H1V3h5v1z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="lib" id="e8acc63b1e238f3255c900eed37254b8-108568ac82340d1d992a14fe9407a041688f1f08" href="/tildeio/rsvp.js/tree/master/lib">lib</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="fix backtick" class="message" href="/tildeio/rsvp.js/commit/eb5bd44912f7513fba88c90c20d4af86df8b6a31">fix backtick</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-08-16T20:08:50Z">Aug 16, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file-directory" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M13 4H7V3c0-.66-.31-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V5c0-.55-.45-1-1-1zM6 4H1V3h5v1z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="server" id="cf1e8c14e54505f60aa10ceb8d5d8ab3-eb45a7712a5bcbc280006458cf20d5a2823efdc4" href="/tildeio/rsvp.js/tree/master/server">server</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="Remove the static middleware." class="message" href="/tildeio/rsvp.js/commit/13378554c6b55a7e637e9b2d3c005f914cc8ba2b">Remove the static middleware.</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2014-12-30T22:05:25Z">Dec 30, 2014</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file-directory" viewBox="0 0 14 16" version="1.1" width="14" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M13 4H7V3c0-.66-.31-1-1-1H1c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1V5c0-.55-.45-1-1-1zM6 4H1V3h5v1z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="test" id="098f6bcd4621d373cade4e832627b4f6-c03f187114c1c55492e44423356098fc405f7c5f" href="/tildeio/rsvp.js/tree/master/test">test</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="allow passing promise values to hash/map/hashSettled" class="message" href="/tildeio/rsvp.js/commit/31653234cd297134deed1ada83943ddc3e07c2ee">allow passing promise values to hash/map/hashSettled</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-06-07T15:49:10Z">Jun 7, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title=".gitignore" id="a084b794bc0759e7a6b77810e01874f2-ef570e3e3f4c49ed0c989933cdf093ea9b86060f" href="/tildeio/rsvp.js/blob/master/.gitignore">.gitignore</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="[BUGFIX release] Replace closure compiler" class="message" href="/tildeio/rsvp.js/commit/c28912fdf4ae4ff87a2a07286d902063a0f7a401">[BUGFIX release] Replace closure compiler</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2014-12-18T18:17:14Z">Dec 18, 2014</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title=".jshintrc" id="4d5aa81bf4f18104bb6ea53a8b5d1f43-be502a304c214611a5b2e4072aea5f44bba1c23e" href="/tildeio/rsvp.js/blob/master/.jshintrc">.jshintrc</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="misc house keeping" class="message" href="/tildeio/rsvp.js/commit/054ba4586f764c7ca4af634285bafbb2850c0c7b">misc house keeping</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2014-02-15T17:27:24Z">Feb 15, 2014</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title=".npmignore" id="0fd4ef892d9d4990033701887c2f9bcc-2ae8934c94281b4f1ccb81577a5d9df59ea40211" href="/tildeio/rsvp.js/blob/master/.npmignore">.npmignore</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="don’t include the built tests" class="message" href="/tildeio/rsvp.js/commit/1979d5ad89293dadbe7656dd53d152f7426fa35e">don’t include the built tests</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2015-03-28T04:46:41Z">Mar 28, 2015</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title=".release.json" id="894a84bc7580bf78bd2866a1fddb10dc-868ec180adee270fdc2098709009b3a996694b23" href="/tildeio/rsvp.js/blob/master/.release.json">.release.json</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="update release-it script" class="message" href="/tildeio/rsvp.js/commit/5727073c53c207bb687b82a1683eb3c1b332960b">update release-it script</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2016-02-13T17:11:09Z">Feb 13, 2016</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title=".travis.yml" id="354f30a63fb0907d4ad57269548329e3-f952892457d8cb9bb0351bd066e18e3f16a662c4" href="/tildeio/rsvp.js/blob/master/.travis.yml">.travis.yml</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="update dependencies" class="message" href="/tildeio/rsvp.js/commit/71ab9f6f89051db1cac70efae90215af405d9315">update dependencies</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-05-21T15:56:36Z">May 21, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="CHANGELOG.md" id="4ac32a78649ca5bdd8e0ba38b7006a1e-f55aa2adee43c5f6949b9a9680dd9bf9cb2d4529" href="/tildeio/rsvp.js/blob/master/CHANGELOG.md">CHANGELOG.md</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="update changelog" class="message" href="/tildeio/rsvp.js/commit/3bc913832dee3815337b59842acb94f1061ff2b2">update changelog</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-02-27T23:20:16Z">Feb 28, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="LICENSE" id="9879d6db96fd29134fc802214163b95a-954ec5992df7508499c41d0e9d7ed74ef5d5032c" itemprop="license" href="/tildeio/rsvp.js/blob/master/LICENSE">LICENSE</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="Add Stefan Penner to license" class="message" href="/tildeio/rsvp.js/commit/d3d19e7fdf2b0146aaa737617e79e2639db8fdd8">Add Stefan Penner to license</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2014-03-01T05:11:48Z">Mar 1, 2014</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="README.md" id="04c6e90faac2675aa89e2176d2eec7d8-e347e5b4cf033a9b6c53a3d36d708a4dd52602aa" href="/tildeio/rsvp.js/blob/master/README.md">README.md</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="Merge pull request #516 from tildeio/remove-s3-publish

remove publish_to_s3 (we use jsdelivr.com pointing at npm now)" class="message" href="/tildeio/rsvp.js/commit/30d74cd3dcf2f9fa80496e4f94d3d8983007ffeb">Merge pull request</a> <a href="https://github.com/tildeio/rsvp.js/pull/516" class="issue-link js-issue-link" data-error-text="Failed to load issue title" data-id="284781545" data-permission-text="Issue title is private" data-url="https://github.com/tildeio/rsvp.js/issues/516">#516</a> <a data-pjax="true" title="Merge pull request #516 from tildeio/remove-s3-publish

remove publish_to_s3 (we use jsdelivr.com pointing at npm now)" class="message" href="/tildeio/rsvp.js/commit/30d74cd3dcf2f9fa80496e4f94d3d8983007ffeb">from tildeio/remove-s3-publish</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2017-12-27T20:23:07Z">Dec 27, 2017</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="ember-cli-build.js" id="2fe2a7faee7de1e0d5d82e032498d84c-3ef884ce59f1db2632dedb86f756672b86d3eb41" href="/tildeio/rsvp.js/blob/master/ember-cli-build.js">ember-cli-build.js</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="update dependencies" class="message" href="/tildeio/rsvp.js/commit/71ab9f6f89051db1cac70efae90215af405d9315">update dependencies</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-05-21T15:56:36Z">May 21, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="package.json" id="b9cfc7f2cdf78a7f4b91a753d10865a2-549fb0953fecf82d1ea767dc3284383576d848c5" href="/tildeio/rsvp.js/blob/master/package.json">package.json</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="release v4.8.3 🎉" class="message" href="/tildeio/rsvp.js/commit/879fe324f9810747f9feac1f679f3c357c0e6627">release v4.8.3 <g-emoji class="g-emoji" alias="tada" fallback-src="https://assets-cdn.github.com/images/icons/emoji/unicode/1f389.png">🎉</g-emoji></a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-07-11T04:00:43Z">Jul 11, 2018</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="testem.js" id="1a0ca09a3f8c753c31615ee16e6199ee-ad2c905fc435d23b1ed2b15286066f5b43d26203" href="/tildeio/rsvp.js/blob/master/testem.js">testem.js</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="Update test stuff" class="message" href="/tildeio/rsvp.js/commit/9738d0c752da664c18fe9d856dfdde03c4db81b8">Update test stuff</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2017-12-22T03:29:34Z">Dec 22, 2017</time-ago></span>
          </td>
        </tr>
        <tr class="js-navigation-item">
          <td class="icon">
            <svg class="octicon octicon-file" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M6 5H2V4h4v1zM2 8h7V7H2v1zm0 2h7V9H2v1zm0 2h7v-1H2v1zm10-7.5V14c0 .55-.45 1-1 1H1c-.55 0-1-.45-1-1V2c0-.55.45-1 1-1h7.5L12 4.5zM11 5L8 2H1v12h10V5z"/></svg>
            <img width="16" height="16" class="spinner" alt="" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" />
          </td>
          <td class="content">
            <span class="css-truncate css-truncate-target"><a class="js-navigation-open" title="yarn.lock" id="8ee2343978836a779dc9f8d6b794c3b2-dd31b1b6f60d92262a7d70f5ac8cfaca73723922" href="/tildeio/rsvp.js/blob/master/yarn.lock">yarn.lock</a></span>
          </td>
          <td class="message">
            <span class="css-truncate css-truncate-target">
                  <a data-pjax="true" title="bump deps" class="message" href="/tildeio/rsvp.js/commit/d30686918e32e1c5a4692151da8979c7a03b6f77">bump deps</a>
            </span>
          </td>
          <td class="age">
            <span class="css-truncate css-truncate-target"><time-ago datetime="2018-07-05T19:05:25Z">Jul 5, 2018</time-ago></span>
          </td>
        </tr>
    </tbody>
  </table>

</div>




  <div id="readme" class="Box Box--condensed instapaper_body md">
    <div class="Box-header px-2 clearfix">
      <h3 class="Box-title pr-3">
        <svg class="octicon octicon-book" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M3 5h4v1H3V5zm0 3h4V7H3v1zm0 2h4V9H3v1zm11-5h-4v1h4V5zm0 2h-4v1h4V7zm0 2h-4v1h4V9zm2-6v9c0 .55-.45 1-1 1H9.5l-1 1-1-1H2c-.55 0-1-.45-1-1V3c0-.55.45-1 1-1h5.5l1 1 1-1H15c.55 0 1 .45 1 1zm-8 .5L7.5 3H2v9h6V3.5zm7-.5H9.5l-.5.5V12h6V3z"/></svg>
        README.md
      </h3>
    </div>
      <div class="Box-body p-6">
        <article class="markdown-body entry-content" itemprop="text"><h1><a id="user-content-rsvpjs---" class="anchor" aria-hidden="true" href="#rsvpjs---"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>RSVP.js  <a href="http://travis-ci.org/tildeio/rsvp.js" rel="nofollow"><img src="https://camo.githubusercontent.com/e7c1352ad03b6300a3ff0276233a2a8876310d49/68747470733a2f2f7365637572652e7472617669732d63692e6f72672f74696c6465696f2f727376702e6a732e7376673f6272616e63683d6d6173746572" alt="Build Status" data-canonical-src="https://secure.travis-ci.org/tildeio/rsvp.js.svg?branch=master" style="max-width:100%;"></a> <a href="http://inch-ci.org/github/tildeio/rsvp.js" rel="nofollow"><img src="https://camo.githubusercontent.com/2e05c6e8729e043287e04a8074e9c08484bd1d38/687474703a2f2f696e63682d63692e6f72672f6769746875622f74696c6465696f2f727376702e6a732e7376673f6272616e63683d6d6173746572" alt="Inline docs" data-canonical-src="http://inch-ci.org/github/tildeio/rsvp.js.svg?branch=master" style="max-width:100%;"></a></h1>
<p>RSVP.js provides simple tools for organizing asynchronous code.</p>
<p>Specifically, it is a tiny implementation of Promises/A+.</p>
<p>It works in node and the browser (IE9+, all the popular evergreen ones).</p>
<h2><a id="user-content-downloads" class="anchor" aria-hidden="true" href="#downloads"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>downloads</h2>
<ul>
<li>rsvp (<a href="https://cdn.jsdelivr.net/npm/rsvp/dist/rsvp.js" rel="nofollow">latest</a> | <a href="https://cdn.jsdelivr.net/npm/rsvp@4/dist/rsvp.js" rel="nofollow">4.x</a>)</li>
<li>rsvp minified (<a href="https://cdn.jsdelivr.net/npm/rsvp/dist/rsvp.min.js" rel="nofollow">latest</a> | <a href="https://cdn.jsdelivr.net/npm/rsvp@4/dist/rsvp.min.js" rel="nofollow">4.x</a>)</li>
</ul>
<h2><a id="user-content-cdn" class="anchor" aria-hidden="true" href="#cdn"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>CDN</h2>
<div class="highlight highlight-text-html-basic"><pre>&lt;<span class="pl-ent">script</span> <span class="pl-e">src</span>=<span class="pl-s"><span class="pl-pds">"</span>https://cdn.jsdelivr.net/npm/rsvp@4/dist/rsvp.min.js<span class="pl-pds">"</span></span>&gt;<span class="pl-s1">&lt;</span>/<span class="pl-ent">script</span>&gt;</pre></div>
<h2><a id="user-content-promises" class="anchor" aria-hidden="true" href="#promises"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Promises</h2>
<p>Although RSVP is ES6 compliant, it does bring along some extra toys. If you
would prefer a strict ES6 subset, I would suggest checking out our sibling
project <a href="https://github.com/stefanpenner/es6-promise">https://github.com/stefanpenner/es6-promise</a>, It is RSVP but stripped
down to the ES6 spec features.</p>
<h2><a id="user-content-node" class="anchor" aria-hidden="true" href="#node"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Node</h2>
<div class="highlight highlight-source-shell"><pre>yarn add --save rsvp
<span class="pl-c"><span class="pl-c">#</span> or ...</span>
npm install --save rsvp</pre></div>
<p><code>RSVP.Promise</code> is an implementation of
<a href="http://promises-aplus.github.com/promises-spec/">Promises/A+</a> that passes the
<a href="https://github.com/promises-aplus/promises-tests">test suite</a>.</p>
<p>It delivers all promises asynchronously, even if the value is already
available, to help you write consistent code that doesn't change if the
underlying data provider changes from synchronous to asynchronous.</p>
<p>It is compatible with <a href="https://github.com/mozilla/task.js">TaskJS</a>, a library
by Dave Herman of Mozilla that uses ES6 generators to allow you to write
synchronous code with promises. It currently works in Firefox, and will work in
any browser that adds support for ES6 generators. See the section below on
TaskJS for more information.</p>
<h3><a id="user-content-basic-usage" class="anchor" aria-hidden="true" href="#basic-usage"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Basic Usage</h3>
<div class="highlight highlight-source-js"><pre><span class="pl-k">var</span> <span class="pl-c1">RSVP</span> <span class="pl-k">=</span> <span class="pl-c1">require</span>(<span class="pl-s"><span class="pl-pds">'</span>rsvp<span class="pl-pds">'</span></span>);

<span class="pl-k">var</span> promise <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-en">RSVP.Promise</span>(<span class="pl-k">function</span>(<span class="pl-smi">resolve</span>, <span class="pl-smi">reject</span>) {
  <span class="pl-c"><span class="pl-c">//</span> succeed</span>
  <span class="pl-en">resolve</span>(value);
  <span class="pl-c"><span class="pl-c">//</span> or reject</span>
  <span class="pl-en">reject</span>(error);
});

<span class="pl-smi">promise</span>.<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">value</span>) {
  <span class="pl-c"><span class="pl-c">//</span> success</span>
}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">error</span>) {
  <span class="pl-c"><span class="pl-c">//</span> failure</span>
});</pre></div>
<p>Once a promise has been resolved or rejected, it cannot be resolved or rejected
again.</p>
<p>Here is an example of a simple XHR2 wrapper written using RSVP.js:</p>
<div class="highlight highlight-source-js"><pre><span class="pl-k">var</span> <span class="pl-en">getJSON</span> <span class="pl-k">=</span> <span class="pl-k">function</span>(<span class="pl-smi">url</span>) {
  <span class="pl-k">var</span> promise <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-en">RSVP.Promise</span>(<span class="pl-k">function</span>(<span class="pl-smi">resolve</span>, <span class="pl-smi">reject</span>){
    <span class="pl-k">var</span> client <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-en">XMLHttpRequest</span>();
    <span class="pl-smi">client</span>.<span class="pl-c1">open</span>(<span class="pl-s"><span class="pl-pds">"</span>GET<span class="pl-pds">"</span></span>, url);
    <span class="pl-smi">client</span>.<span class="pl-c1">onreadystatechange</span> <span class="pl-k">=</span> handler;
    <span class="pl-smi">client</span>.<span class="pl-smi">responseType</span> <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>json<span class="pl-pds">"</span></span>;
    <span class="pl-smi">client</span>.<span class="pl-c1">setRequestHeader</span>(<span class="pl-s"><span class="pl-pds">"</span>Accept<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>application/json<span class="pl-pds">"</span></span>);
    <span class="pl-smi">client</span>.<span class="pl-c1">send</span>();

    <span class="pl-k">function</span> <span class="pl-en">handler</span>() {
      <span class="pl-k">if</span> (<span class="pl-c1">this</span>.<span class="pl-c1">readyState</span> <span class="pl-k">===</span> <span class="pl-c1">this</span>.<span class="pl-c1">DONE</span>) {
        <span class="pl-k">if</span> (<span class="pl-c1">this</span>.<span class="pl-c1">status</span> <span class="pl-k">===</span> <span class="pl-c1">200</span>) { <span class="pl-en">resolve</span>(<span class="pl-c1">this</span>.<span class="pl-smi">response</span>); }
        <span class="pl-k">else</span> { <span class="pl-en">reject</span>(<span class="pl-c1">this</span>); }
      }
    };
  });

  <span class="pl-k">return</span> promise;
};

<span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/posts.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">json</span>) {
  <span class="pl-c"><span class="pl-c">//</span> continue</span>
}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">error</span>) {
  <span class="pl-c"><span class="pl-c">//</span> handle errors</span>
});</pre></div>
<h3><a id="user-content-chaining" class="anchor" aria-hidden="true" href="#chaining"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Chaining</h3>
<p>One of the really awesome features of Promises/A+ promises are that they can be
chained together. In other words, the return value of the first
resolve handler will be passed to the second resolve handler.</p>
<p>If you return a regular value, it will be passed, as is, to the next handler.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/posts.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">json</span>) {
  <span class="pl-k">return</span> <span class="pl-smi">json</span>.<span class="pl-smi">post</span>;
}).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">post</span>) {
  <span class="pl-c"><span class="pl-c">//</span> proceed</span>
});</pre></div>
<p>The really awesome part comes when you return a promise from the first handler:</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/post/1.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">post</span>) {
  <span class="pl-c"><span class="pl-c">//</span> save off post</span>
  <span class="pl-k">return</span> <span class="pl-en">getJSON</span>(<span class="pl-smi">post</span>.<span class="pl-smi">commentURL</span>);
}).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">comments</span>) {
  <span class="pl-c"><span class="pl-c">//</span> proceed with access to post and comments</span>
});</pre></div>
<p>This allows you to flatten out nested callbacks, and is the main feature of
promises that prevents "rightward drift" in programs with a lot of asynchronous
code.</p>
<p>Errors also propagate:</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/posts.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">posts</span>) {

}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">error</span>) {
  <span class="pl-c"><span class="pl-c">//</span> since no rejection handler was passed to the</span>
  <span class="pl-c"><span class="pl-c">//</span> first `.then`, the error propagates.</span>
});</pre></div>
<p>You can use this to emulate <code>try/catch</code> logic in synchronous code. Simply chain
as many resolve callbacks as you want, and add a failure handler at the end to
catch errors.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/post/1.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">post</span>) {
  <span class="pl-k">return</span> <span class="pl-en">getJSON</span>(<span class="pl-smi">post</span>.<span class="pl-smi">commentURL</span>);
}).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">comments</span>) {
  <span class="pl-c"><span class="pl-c">//</span> proceed with access to posts and comments</span>
}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">error</span>) {
  <span class="pl-c"><span class="pl-c">//</span> handle errors in either of the two requests</span>
});</pre></div>
<h2><a id="user-content-error-handling" class="anchor" aria-hidden="true" href="#error-handling"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Error Handling</h2>
<p>There are times when dealing with promises that it seems like any errors are
being 'swallowed', and not properly raised. This makes it extremely difficult
to track down where a given issue is coming from. Thankfully, <code>RSVP</code> has a
solution for this problem built in.</p>
<p>You can register functions to be called when an uncaught error occurs within
your promises. These callback functions can be anything, but a common practice
is to call <code>console.assert</code> to dump the error to the console.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>error<span class="pl-pds">'</span></span>, <span class="pl-k">function</span>(<span class="pl-smi">reason</span>) {
  <span class="pl-en">console</span>.<span class="pl-c1">assert</span>(<span class="pl-c1">false</span>, reason);
});</pre></div>
<p><code>RSVP</code> allows Promises to be labeled: <code>Promise.resolve(value, 'I AM A LABEL')</code>
If provided, this label is passed as the second argument to <code>RSVP.on('error')</code></p>
<div class="highlight highlight-source-js"><pre><span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>error<span class="pl-pds">'</span></span>, <span class="pl-k">function</span>(<span class="pl-smi">reason</span>, <span class="pl-smi">label</span>) {
  <span class="pl-k">if</span> (label) {
    <span class="pl-en">console</span>.<span class="pl-c1">error</span>(label);
  }

  <span class="pl-en">console</span>.<span class="pl-c1">assert</span>(<span class="pl-c1">false</span>, reason);
});</pre></div>
<p><strong>NOTE:</strong> promises do allow for errors to be handled asynchronously, so this
callback may result in false positives.</p>
<h2><a id="user-content-finally" class="anchor" aria-hidden="true" href="#finally"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Finally</h2>
<p><code>finally</code> will be invoked regardless of the promise's fate, just as native
try/catch/finally behaves.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">findAuthor</span>().<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">reason</span>){
  <span class="pl-k">return</span> <span class="pl-en">findOtherAuthor</span>();
}).<span class="pl-c1">finally</span>(<span class="pl-k">function</span>(){
  <span class="pl-c"><span class="pl-c">//</span> author was either found, or not</span>
});</pre></div>
<h2><a id="user-content-arrays-of-promises" class="anchor" aria-hidden="true" href="#arrays-of-promises"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Arrays of promises</h2>
<p>Sometimes you might want to work with many promises at once. If you pass an
array of promises to the <code>all()</code> method it will return a new promise that will
be fulfilled when all of the promises in the array have been fulfilled; or
rejected immediately if any promise in the array is rejected.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-k">var</span> promises <span class="pl-k">=</span> [<span class="pl-c1">2</span>, <span class="pl-c1">3</span>, <span class="pl-c1">5</span>, <span class="pl-c1">7</span>, <span class="pl-c1">11</span>, <span class="pl-c1">13</span>].<span class="pl-en">map</span>(<span class="pl-k">function</span>(<span class="pl-smi">id</span>){
  <span class="pl-k">return</span> <span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/post/<span class="pl-pds">"</span></span> <span class="pl-k">+</span> id <span class="pl-k">+</span> <span class="pl-s"><span class="pl-pds">"</span>.json<span class="pl-pds">"</span></span>);
});

<span class="pl-c1">RSVP</span>.<span class="pl-c1">all</span>(promises).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">posts</span>) {
  <span class="pl-c"><span class="pl-c">//</span> posts contains an array of results for the given promises</span>
}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">reason</span>){
  <span class="pl-c"><span class="pl-c">//</span> if any of the promises fails.</span>
});</pre></div>
<h2><a id="user-content-hash-of-promises" class="anchor" aria-hidden="true" href="#hash-of-promises"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Hash of promises</h2>
<p>If you need to reference many promises at once (like <code>all()</code>), but would like
to avoid encoding the actual promise order you can use <code>hash()</code>. If you pass an
object literal (where the values are promises) to the <code>hash()</code> method it will
return a new promise that will be fulfilled when all of the promises have been
fulfilled; or rejected immediately if any promise is rejected.</p>
<p>The key difference to the <code>all()</code> function is that both the fulfillment value
and the argument to the <code>hash()</code> function are object literals. This allows you
to simply reference the results directly off the returned object without having
to remember the initial order like you would with <code>all()</code>.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-k">var</span> promises <span class="pl-k">=</span> {
  posts<span class="pl-k">:</span> <span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/posts.json<span class="pl-pds">"</span></span>),
  users<span class="pl-k">:</span> <span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/users.json<span class="pl-pds">"</span></span>)
};

<span class="pl-c1">RSVP</span>.<span class="pl-c1">hash</span>(promises).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">results</span>) {
  <span class="pl-en">console</span>.<span class="pl-c1">log</span>(<span class="pl-smi">results</span>.<span class="pl-smi">users</span>) <span class="pl-c"><span class="pl-c">//</span> print the users.json results</span>
  <span class="pl-en">console</span>.<span class="pl-c1">log</span>(<span class="pl-smi">results</span>.<span class="pl-smi">posts</span>) <span class="pl-c"><span class="pl-c">//</span> print the posts.json results</span>
});</pre></div>
<h2><a id="user-content-all-settled-and-hash-settled" class="anchor" aria-hidden="true" href="#all-settled-and-hash-settled"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>All settled and hash settled</h2>
<p>Sometimes you want to work with several promises at once, but instead of
rejecting immediately if any promise is rejected, as with <code>all()</code> or <code>hash()</code>,
you want to be able to inspect the results of all your promises, whether they
fulfill or reject. For this purpose, you can use <code>allSettled()</code> and
<code>hashSettled()</code>. These work exactly like <code>all()</code> and <code>hash()</code>, except that they
fulfill with an array or hash (respectively) of the constituent promises'
result states. Each state object will either indicate fulfillment or rejection,
and provide the corresponding value or reason. The states will take
one of the following formats:</p>
<div class="highlight highlight-source-js"><pre>{ state<span class="pl-k">:</span> <span class="pl-s"><span class="pl-pds">'</span>fulfilled<span class="pl-pds">'</span></span>, value<span class="pl-k">:</span> value }
  or
{ state<span class="pl-k">:</span> <span class="pl-s"><span class="pl-pds">'</span>rejected<span class="pl-pds">'</span></span>, reason<span class="pl-k">:</span> reason }</pre></div>
<h2><a id="user-content-deferred" class="anchor" aria-hidden="true" href="#deferred"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Deferred</h2>
<blockquote>
<p>The <code>RSVP.Promise</code> constructor is generally a better, less error-prone choice
than <code>RSVP.defer()</code>. Promises are recommended unless the specific
properties of deferred are needed.</p>
</blockquote>
<p>Sometimes one needs to create a deferred object, without immediately specifying
how it will be resolved. These deferred objects are essentially a wrapper
around a promise, whilst providing late access to the <code>resolve()</code> and
<code>reject()</code> methods.</p>
<p>A deferred object has this form: <code>{ promise, resolve(x), reject(r) }</code>.</p>
<div class="highlight highlight-source-js"><pre><span class="pl-k">var</span> deferred <span class="pl-k">=</span> <span class="pl-c1">RSVP</span>.<span class="pl-c1">defer</span>();
<span class="pl-c"><span class="pl-c">//</span> ...</span>
<span class="pl-smi">deferred</span>.<span class="pl-smi">promise</span> <span class="pl-c"><span class="pl-c">//</span> access the promise</span>
<span class="pl-c"><span class="pl-c">//</span> ...</span>
<span class="pl-smi">deferred</span>.<span class="pl-en">resolve</span>();
</pre></div>
<h2><a id="user-content-taskjs" class="anchor" aria-hidden="true" href="#taskjs"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>TaskJS</h2>
<p>The <a href="https://github.com/mozilla/task.js">TaskJS</a> library makes it possible to take
promises-oriented code and make it synchronous using ES6 generators.</p>
<p>Let's review an earlier example:</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/post/1.json<span class="pl-pds">"</span></span>).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">post</span>) {
  <span class="pl-k">return</span> <span class="pl-en">getJSON</span>(<span class="pl-smi">post</span>.<span class="pl-smi">commentURL</span>);
}).<span class="pl-c1">then</span>(<span class="pl-k">function</span>(<span class="pl-smi">comments</span>) {
  <span class="pl-c"><span class="pl-c">//</span> proceed with access to posts and comments</span>
}).<span class="pl-c1">catch</span>(<span class="pl-k">function</span>(<span class="pl-smi">reason</span>) {
  <span class="pl-c"><span class="pl-c">//</span> handle errors in either of the two requests</span>
});</pre></div>
<p>Without any changes to the implementation of <code>getJSON</code>, you could write
the following code with TaskJS:</p>
<div class="highlight highlight-source-js"><pre><span class="pl-en">spawn</span>(<span class="pl-k">function</span> <span class="pl-k">*</span>() {
  <span class="pl-k">try</span> {
    <span class="pl-k">var</span> post <span class="pl-k">=</span> <span class="pl-k">yield</span> <span class="pl-en">getJSON</span>(<span class="pl-s"><span class="pl-pds">"</span>/post/1.json<span class="pl-pds">"</span></span>);
    <span class="pl-k">var</span> comments <span class="pl-k">=</span> <span class="pl-k">yield</span> <span class="pl-en">getJSON</span>(<span class="pl-smi">post</span>.<span class="pl-smi">commentURL</span>);
  } <span class="pl-k">catch</span>(error) {
    <span class="pl-c"><span class="pl-c">//</span> handle errors</span>
  }
});</pre></div>
<p>In the above example, <code>function *</code> is new syntax in ES6 for
<a href="http://wiki.ecmascript.org/doku.php?id=harmony:generators" rel="nofollow">generators</a>. Inside
a generator, <code>yield</code> pauses the generator, returning control to the function
that invoked the generator. In this case, the invoker is a special function
that understands the semantics of Promises/A, and will automatically resume the
generator as soon as the promise is resolved.</p>
<p>The cool thing here is the same promises that work with current
JavaScript using <code>.then</code> will work seamlessly with TaskJS once a browser
has implemented it!</p>
<h2><a id="user-content-instrumentation" class="anchor" aria-hidden="true" href="#instrumentation"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Instrumentation</h2>
<div class="highlight highlight-source-js"><pre><span class="pl-k">function</span> <span class="pl-en">listener</span> (<span class="pl-c1">event</span>) {
  <span class="pl-c1">event</span>.<span class="pl-smi">guid</span>      <span class="pl-c"><span class="pl-c">//</span> guid of promise. Must be globally unique, not just within the implementation</span>
  <span class="pl-c1">event</span>.<span class="pl-smi">childGuid</span> <span class="pl-c"><span class="pl-c">//</span> child of child promise (for chained via `then`)</span>
  <span class="pl-c1">event</span>.<span class="pl-smi">eventName</span> <span class="pl-c"><span class="pl-c">//</span> one of ['created', 'chained', 'fulfilled', 'rejected']</span>
  <span class="pl-c1">event</span>.<span class="pl-smi">detail</span>    <span class="pl-c"><span class="pl-c">//</span> fulfillment value or rejection reason, if applicable</span>
  <span class="pl-c1">event</span>.<span class="pl-c1">label</span>     <span class="pl-c"><span class="pl-c">//</span> label passed to promise's constructor</span>
  <span class="pl-c1">event</span>.<span class="pl-smi">timeStamp</span> <span class="pl-c"><span class="pl-c">//</span> milliseconds elapsed since 1 January 1970 00:00:00 UTC up until now</span>
  <span class="pl-c1">event</span>.<span class="pl-smi">stack</span>     <span class="pl-c"><span class="pl-c">//</span> stack at the time of the event. (if  'instrument-with-stack' is true)</span>
}

<span class="pl-c1">RSVP</span>.<span class="pl-en">configure</span>(<span class="pl-s"><span class="pl-pds">'</span>instrument<span class="pl-pds">'</span></span>, <span class="pl-c1">true</span> <span class="pl-k">|</span> <span class="pl-c1">false</span>);
<span class="pl-c"><span class="pl-c">//</span> capturing the stacks is slow, so you also have to opt in</span>
<span class="pl-c1">RSVP</span>.<span class="pl-en">configure</span>(<span class="pl-s"><span class="pl-pds">'</span>instrument-with-stack<span class="pl-pds">'</span></span>, <span class="pl-c1">true</span> <span class="pl-k">|</span> <span class="pl-c1">false</span>);

<span class="pl-c"><span class="pl-c">//</span> events</span>
<span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>created<span class="pl-pds">'</span></span>, listener);
<span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>chained<span class="pl-pds">'</span></span>, listener);
<span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>fulfilled<span class="pl-pds">'</span></span>, listener);
<span class="pl-c1">RSVP</span>.<span class="pl-en">on</span>(<span class="pl-s"><span class="pl-pds">'</span>rejected<span class="pl-pds">'</span></span>, listener);</pre></div>
<p>Events are only triggered when <code>RSVP.configure('instrument')</code> is true, although
listeners can be registered at any time.</p>
<h2><a id="user-content-building--testing" class="anchor" aria-hidden="true" href="#building--testing"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Building &amp; Testing</h2>
<p>Custom tasks:</p>
<ul>
<li><code>npm test</code> - build &amp; test</li>
<li><code>npm test:node</code> - build &amp; test just node</li>
<li><code>npm test:server</code> - build/watch &amp; test</li>
<li><code>npm run build</code> - Build</li>
<li><code>npm run build:production</code> - Build production (with minified output)</li>
<li><code>npm start</code> - build, watch and run interactive server at <a href="http://localhost:4200" rel="nofollow">http://localhost:4200</a>'</li>
</ul>
<h2><a id="user-content-releasing" class="anchor" aria-hidden="true" href="#releasing"><svg class="octicon octicon-link" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M4 9h1v1H4c-1.5 0-3-1.69-3-3.5S2.55 3 4 3h4c1.45 0 3 1.69 3 3.5 0 1.41-.91 2.72-2 3.25V8.59c.58-.45 1-1.27 1-2.09C10 5.22 8.98 4 8 4H4c-.98 0-2 1.22-2 2.5S3 9 4 9zm9-3h-1v1h1c1 0 2 1.22 2 2.5S13.98 12 13 12H9c-.98 0-2-1.22-2-2.5 0-.83.42-1.64 1-2.09V6.25c-1.09.53-2 1.84-2 3.25C6 11.31 7.55 13 9 13h4c1.45 0 3-1.69 3-3.5S14.5 6 13 6z"></path></svg></a>Releasing</h2>
<p>Check what release-it will do by running <code>npm run-script dry-run-release</code>.
To actually release, run <code>node_modules/.bin/release-it</code>.</p>
</article>
      </div>
  </div>


  </div>
  <div class="modal-backdrop js-touch-events"></div>
</div>

    </div>
  </div>

  </div>

        
<div class="footer container-lg px-3" role="contentinfo">
  <div class="position-relative d-flex flex-justify-between pt-6 pb-2 mt-6 f6 text-gray border-top border-gray-light ">
    <ul class="list-style-none d-flex flex-wrap ">
      <li class="mr-3">&copy; 2018 <span title="0.37527s from unicorn-1812383339-bjv4q">GitHub</span>, Inc.</li>
        <li class="mr-3"><a data-ga-click="Footer, go to terms, text:terms" href="https://github.com/site/terms">Terms</a></li>
        <li class="mr-3"><a data-ga-click="Footer, go to privacy, text:privacy" href="https://github.com/site/privacy">Privacy</a></li>
        <li class="mr-3"><a href="https://help.github.com/articles/github-security/" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li class="mr-3"><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
        <li><a data-ga-click="Footer, go to help, text:help" href="https://help.github.com">Help</a></li>
    </ul>

    <a aria-label="Homepage" title="GitHub" class="footer-octicon mr-lg-4" href="https://github.com">
      <svg height="24" class="octicon octicon-mark-github" viewBox="0 0 16 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
</a>
   <ul class="list-style-none d-flex flex-wrap ">
        <li class="mr-3"><a data-ga-click="Footer, go to contact, text:contact" href="https://github.com/contact">Contact GitHub</a></li>
        <li class="mr-3"><a href="https://github.com/pricing" data-ga-click="Footer, go to Pricing, text:Pricing">Pricing</a></li>
      <li class="mr-3"><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li class="mr-3"><a href="https://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
        <li class="mr-3"><a href="https://blog.github.com" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a data-ga-click="Footer, go to about, text:about" href="https://github.com/about">About</a></li>

    </ul>
  </div>
  <div class="d-flex flex-justify-center pb-6">
    <span class="f6 text-gray-light"></span>
  </div>
</div>



  <div id="ajax-error-message" class="ajax-error-message flash flash-error">
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.893 1.5c-.183-.31-.52-.5-.887-.5s-.703.19-.886.5L.138 13.499a.98.98 0 0 0 0 1.001c.193.31.53.501.886.501h13.964c.367 0 .704-.19.877-.5a1.03 1.03 0 0 0 .01-1.002L8.893 1.5zm.133 11.497H6.987v-2.003h2.039v2.003zm0-3.004H6.987V5.987h2.039v4.006z"/></svg>
    <button type="button" class="flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
      <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg>
    </button>
    You can’t perform that action at this time.
  </div>


    <script crossorigin="anonymous" integrity="sha512-RJ1ufbxsSbKjRCyYvinsPNKvTBvcvvKUvEOJ8g+GjtWI5SuRr+QPBlZcvRDws4H9YwAgdQFcGxfL8UbwEfdI7A==" type="application/javascript" src="https://assets-cdn.github.com/assets/compat-daf14de28fadf1e2bc40d100cb773e2b.js"></script>
    <script crossorigin="anonymous" integrity="sha512-vuSiumVQ19SCEH15AK/fmR75d/qAL38iC7QVE4YnlvgNa7uBa92nr/qPt9zS3E6CrWpq7wa9awDPuzphrnHT5w==" type="application/javascript" src="https://assets-cdn.github.com/assets/frameworks-bf2c22b1c392529e298b629d4e812b82.js"></script>
    
    <script crossorigin="anonymous" async="async" integrity="sha512-RKQzJE/1Sb6lFY1veyzarSkJobDSP1D9G1OWe1AQJ072Oz0IqOPpWwxJj++zf0PkMknWsXXY26Q76AY/2euAdg==" type="application/javascript" src="https://assets-cdn.github.com/assets/github-e4b651bc3a0d2b00fbf2dce9b73252a8.js"></script>
    
    
    
  <div class="js-stale-session-flash stale-session-flash flash flash-warn flash-banner d-none">
    <svg class="octicon octicon-alert" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8.893 1.5c-.183-.31-.52-.5-.887-.5s-.703.19-.886.5L.138 13.499a.98.98 0 0 0 0 1.001c.193.31.53.501.886.501h13.964c.367 0 .704-.19.877-.5a1.03 1.03 0 0 0 .01-1.002L8.893 1.5zm.133 11.497H6.987v-2.003h2.039v2.003zm0-3.004H6.987V5.987h2.039v4.006z"/></svg>
    <span class="signed-in-tab-flash">You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
    <span class="signed-out-tab-flash">You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
  </div>
  <div class="facebox" id="facebox" style="display:none;">
  <div class="facebox-popup">
    <div class="facebox-content" role="dialog" aria-labelledby="facebox-header" aria-describedby="facebox-description">
    </div>
    <button type="button" class="facebox-close js-facebox-close" aria-label="Close modal">
      <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg>
    </button>
  </div>
</div>

  <template id="site-details-dialog">
  <details class="details-reset details-overlay details-overlay-dark lh-default text-gray-dark" open>
    <summary aria-haspopup="dialog" aria-label="Close dialog"></summary>
    <details-dialog class="Box Box--overlay d-flex flex-column anim-fade-in fast">
      <button class="m-3 btn-octicon position-absolute right-0 top-0" type="button" aria-label="Close dialog" data-close-dialog>
        <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg>
      </button>
      <div class="octocat-spinner my-6 js-details-dialog-spinner"></div>
    </details-dialog>
  </details>
</template>

  <div class="Popover js-hovercard-content position-absolute" style="display: none; outline: none;" tabindex="0">
  <div class="Popover-message Popover-message--bottom-left Popover-message--large Box box-shadow-large" style="width:360px;">
  </div>
</div>

<div id="hovercard-aria-description" class="sr-only">
  Press h to open a hovercard with more details.
</div>


  </body>
</html>

