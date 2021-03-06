/*
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
 */

package clockwerk.global;

public enum GlobalFileUser {
	FILE		("settings.ini"),
	SECTION		("settings"),
	BOUNTY		("bounty"),
	CAMPS		("camps"),
	WARNINGS	("warnings"),
	VOLUME		("volume"),
	TOGGLE		("toggle"),
	MUTE		("mute"),
	THEME		("theme");
	
	private String
		settings;
	
	GlobalFileUser( String settings ) { this.settings = settings; }
	public String settings( ) { return settings; }
}