<!--
 * Clockwerk: Dota 2 Rune and Camp Stacking Timer.
 * Copyright (C) 2017 AR.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<html>
	<head>
		<title>Dota 2 - On the Clockwerk</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/flick/jquery-ui.css" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		
		<link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One" rel="stylesheet">
        
        <?php include "include/user.php"; init( ); ?>
		
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		<style>
			#volume {
				position: fixed;
				bottom: 0%;
				width: 100%;
			}
      
            #settingsButton {
               position: fixed;
               top: 3%;
	           left: 50%;
	           transform: translate(-50%, -50%);
            }
		</style>

        <script type="text/javascript" src="js/ui.js"></script>
        <script type="text/javascript" src="js/settings.js"></script>
        <script type="text/javascript" src="js/time.js"></script>
        <script type="text/javascript" src="js/audio.js"></script>
        <script type="text/javascript" src="js/key.js"></script>
        <script type="text/javascript" src="js/theme.js"></script>
		<script type="text/javascript">
            var
                b_timer_active,
                b_thirty,
                b_fifteen,
                b_ontime,
                b_runes,
                b_stacks,
                b_muted = false;
           
			$( function( ) {
                /* EVENTS */
                $( "#settingsButton" ).click( function( event ) {
                    $( "#f_settings_dia" ).effect( "slide" );
                    f_settings_dia.dialog( "open" );
                });
                
                $( "#i_runes" ).click( function( event ) {
                    b_runes = $( "#i_runes" ).is( ':checked' );
                    updateUserButtonValues( "runes" );
                });
                
                $( "#i_camps" ).click( function( event ) {
                    b_stacks = $( "#i_camps" ).is( ':checked' );
                    updateUserButtonValues( "camps" );
                });
                
                $( "#i_thirty" ).click( function( event ) {
                    b_thirty = $( "#i_thirty" ).is( ':checked' );
                    updateUserButtonValues( "thirty" );
                });
                
                $( "#i_fifteen" ).click( function( event ) {
                    b_fifteen = $( "#i_fifteen" ).is( ':checked' );
                    updateUserButtonValues( "fifteen" );
                });
                
                $( "#i_ontime" ).click( function( event ) {
                    b_ontime = $( "#i_ontime" ).is( ':checked' );
                    updateUserButtonValues( "ontime" );
                });
                
                $( "#toggleButton" ).click( function( event ) {
                    i_changing = 1;
                    refreshShortcutContent( );
                    $("#shortcut").dialog("open");
                });
                
                $( "#muteButton" ).click( function( event ) {
                    i_changing = 2;
                    refreshShortcutContent( );
                    $("#shortcut").dialog("open");
                });
                
                $( "#theme_cw" ).click( function( event ) {
                    changeTheme( "Clockwerk" );
                });
                
                $( "#theme_cm" ).click( function( event ) {
                    changeTheme( "Crystal Maiden" );
                });
                
                $( "#theme_invoker" ).click( function( event ) {
                    changeTheme( "Invoker" );
                });
                
                updateClock( );
           
                try {
                    if( b_db_error ) {
                        showNotification( "There was an error loading your settings!" );
                        changeTheme( "Clockwerk", 1 );
                    }
                } catch( e ) {
                    updateButtonToSettings( "runes" );
                    updateButtonToSettings( "camps" );
                    updateButtonToSettings( "thirty" );
                    updateButtonToSettings( "fifteen" );
                    updateButtonToSettings( "ontime" );
                    updateButtonToSettings( "toggleButton" );
                    updateButtonToSettings( "muteButton" );    
                    changeTheme( a_user_data[ "theme" ], 1 );
                }
			}); 
            
            $(document).ready(function( ){
                $('#layer').fadeIn(); 
            });
		</script>   
	</head>
	
	<body>
		<div id="layer">   
			<div id="clock"></div>
            <div id="start" title="Clockwerk"><p>Welcome to Clockwerk. <br /><br />Just be aware that if you plan on using the web version of this application,
            you cannot activiate your shortcut keys <b>unless</b> the browser is focused. <br /><br />Download the client version for complete
            access.</p></div>
            
            <div id="shortcut" title="Clockwerk"></div>
			<div id="notifymessage" title="Clockwerk"></div>
            
            <button id="settingsButton" class="ui-button ui-widget ui-corner-all">Settings</button>
            
            <div id="settingsdialog" title="Settings">
                <fieldset>
                    <legend>Settings</legend>
                    <div class="gensettings">
                        <label for="i_runes">Runes</label>
                        <input type="checkbox" name="i_runes" id="i_runes">
                        <label for="i_camps">Camp Stacks</label>
                        <input type="checkbox" name="i_camps" id="i_camps">
                    </div>
                </fieldset>
                
                <br />
                
                <fieldset>
                    <legend>Warning Settings</legend>
                    <div class="gensettings">
                        <label for="i_thirty">30 Seconds</label>
                        <input type="checkbox" name="i_thirty" id="i_thirty">
                        <label for="i_fifteen">15 Seconds</label>
                        <input type="checkbox" name="i_fifteen" id="i_fifteen">
                        <label for="i_ontime">On Time</label>
                        <input type="checkbox" name="i_ontime" id="i_ontime">
                    </div>
                </fieldset>
                
                <br />
                
                <fieldset>
                    <legend>Shortcuts</legend>
                    <div class="gensettings">
                        <button id="toggleButton" class="ui-button ui-widget ui-corner-all">Start/Stop Key</button>
                        <button id="muteButton" class="ui-button ui-widget ui-corner-all">Mute Key</button>
                    </div>
                </fieldset>
                
                <br />
                
                <fieldset>
                    <legend>Themes</legend>
                    <div class="gensettings">     
                        <label for="theme_cw">Clockwerk</label>
                        <input type="checkbox" name="theme_cw" id="theme_cw">
                        
                        <label for="theme_cm">Crystal Maiden</label>
                        <input type="checkbox" name="theme_cm" id="theme_cm">
                        
                        <label for="theme_invoker">Invoker</label>
                        <input type="checkbox" name="theme_invoker" id="theme_invoker">
                    </div>
                </fieldset>
            </div>
			<div id="volume"></div>
        </div>
	</body>
</html>