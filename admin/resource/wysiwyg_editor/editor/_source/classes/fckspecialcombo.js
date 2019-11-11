﻿/*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2005 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * "Support Open Source software. What about a donation today?"
 * 
 * File Name: fckspecialcombo.js
 * 	FCKSpecialCombo Class: represents a special combo.
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
 */

var FCKSpecialCombo = function( caption, fieldWidth, panelWidth, panelMaxHeight, parentWindow )
{
	// Default properties values.
	this.FieldWidth		= fieldWidth || 100 ;
	this.PanelWidth		= panelWidth || 150 ;
	this.PanelMaxHeight	= panelMaxHeight || 150 ;
	this.Label			= '&nbsp;' ;
	this.Caption		= caption ;
	this.Tooltip		= caption ;
	this.Style			= FCK_TOOLBARITEM_ICONTEXT ;

	this.Enabled = true ;
	
	this.Items = new Object() ;
	
	this._Panel = new FCKPanel( parentWindow ) ;
	this._Panel.AppendStyleSheet( FCKConfig.SkinPath + 'fck_contextmenu.css' ) ;
	this._PanelBox = this._Panel.PanelDiv.appendChild( this._Panel.Document.createElement( 'DIV' ) ) ;
	this._PanelBox.className = 'SC_Panel' ;
	this._PanelBox.style.width = this.PanelWidth + 'px' ;

	this._PanelBox.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%" style="TABLE-LAYOUT: fixed"><tr><td nowrap></td></tr></table>' ;
	
	this._ItemsHolderEl = this._PanelBox.getElementsByTagName('TD')[0] ;
	
//	this._Panel.StyleSheet = FCKConfig.SkinPath + 'fck_contextmenu.css' ;
//	this._Panel.Create() ;
//	this._Panel.PanelDiv.className += ' SC_Panel' ;
//	this._Panel.PanelDiv.innerHTML = '<table cellpadding="0" cellspacing="0" width="100%" style="TABLE-LAYOUT: fixed"><tr><td nowrap></td></tr></table>' ;
//	this._ItemsHolderEl = this._Panel.PanelDiv.getElementsByTagName('TD')[0] ;
}

function FCKSpecialCombo_ItemOnMouseOver()
{
	this.className += ' SC_ItemOver' ;
}

function FCKSpecialCombo_ItemOnMouseOut()
{
	this.className = this.originalClass ;
}

function FCKSpecialCombo_ItemOnClick()
{
	this.FCKSpecialCombo._Panel.Hide() ;

	this.FCKSpecialCombo.SetLabel( this.FCKItemLabel ) ;

	if ( typeof( this.FCKSpecialCombo.OnSelect ) == 'function' )
		this.FCKSpecialCombo.OnSelect( this.FCKItemID, this ) ;
}

FCKSpecialCombo.prototype.AddItem = function( id, html, label )
{
	// <div class="SC_Item" onmouseover="this.className='SC_Item SC_ItemOver';" onmouseout="this.className='SC_Item';"><b>Bold 1</b></div>
	var oDiv = this._ItemsHolderEl.appendChild( this._Panel.Document.createElement( 'DIV' ) ) ;
	oDiv.className = oDiv.originalClass = 'SC_Item' ;
	oDiv.innerHTML = html ;
	oDiv.FCKItemID = id ;
	oDiv.FCKItemLabel = label ? label : id ;
	oDiv.FCKSpecialCombo = this ;
	oDiv.Selected = false ;

	oDiv.onmouseover	= FCKSpecialCombo_ItemOnMouseOver ;
	oDiv.onmouseout		= FCKSpecialCombo_ItemOnMouseOut ;
	oDiv.onclick		= FCKSpecialCombo_ItemOnClick ;
	
	this.Items[ id.toString().toLowerCase() ] = oDiv ;
	
	return oDiv ;
}

FCKSpecialCombo.prototype.SelectItem = function( itemId )
{
	itemId = itemId ? itemId.toString().toLowerCase() : '' ;
	
	var oDiv = this.Items[ itemId ] ;
	if ( oDiv )
	{
		oDiv.className = oDiv.originalClass = 'SC_ItemSelected' ;
		oDiv.Selected = true ;
	}
}

FCKSpecialCombo.prototype.SelectItemByLabel = function( itemLabel, setLabel )
{
	for ( var id in this.Items )
	{
		var oDiv = this.Items[id] ;

		if ( oDiv.FCKItemLabel == itemLabel )
		{
			oDiv.className = oDiv.originalClass = 'SC_ItemSelected' ;
			oDiv.Selected = true ;
			
			if ( setLabel )
				this.SetLabel( itemLabel ) ;
		}
	}
}

FCKSpecialCombo.prototype.DeselectAll = function( clearLabel )
{
	for ( var i in this.Items )
	{
		this.Items[i].className = this.Items[i].originalClass = 'SC_Item' ;
		this.Items[i].Selected = false ;
	}
	
	if ( clearLabel )
		this.SetLabel( '' ) ;
}

FCKSpecialCombo.prototype.SetLabelById = function( id )
{
	id = id ? id.toString().toLowerCase() : '' ;
	
	var oDiv = this.Items[ id ] ;
	this.SetLabel( oDiv ? oDiv.FCKItemLabel : '' ) ;
}

FCKSpecialCombo.prototype.SetLabel = function( text )
{
	this.Label = text.length == 0 ? '&nbsp;' : text ;

	if ( this._LabelEl )
		this._LabelEl.innerHTML = this.Label ;
}

FCKSpecialCombo.prototype.SetEnabled = function( isEnabled )
{
	this.Enabled = isEnabled ;
	
	this._OuterTable.className = isEnabled ? '' : 'SC_FieldDisabled' ;
}

FCKSpecialCombo.prototype.Create = function( targetElement )
{
	this._OuterTable = targetElement.appendChild( document.createElement( 'TABLE' ) ) ;
	this._OuterTable.cellPadding = 0 ;
	this._OuterTable.cellSpacing = 0 ;
	
	this._OuterTable.insertRow(-1) ;
	
	var sClass ;
	var bShowLabel ;
	
	switch ( this.Style )
	{
		case FCK_TOOLBARITEM_ONLYICON :
			sClass = 'TB_ButtonType_Icon' ;
			bShowLabel = false;
			break ;
		case FCK_TOOLBARITEM_ONLYTEXT :
			sClass = 'TB_ButtonType_Text' ;
			bShowLabel = false;
			break ;
		case FCK_TOOLBARITEM_ICONTEXT :
			bShowLabel = true;
			break ;
	}

	if ( this.Caption && this.Caption.length > 0 && bShowLabel )
	{
		var oCaptionCell = this._OuterTable.rows[0].insertCell(-1) ;
		oCaptionCell.innerHTML = this.Caption ;
		oCaptionCell.className = 'SC_FieldCaption' ;
	}
	
	// Create the main DIV element.
	var oField = this._OuterTable.rows[0].insertCell(-1).appendChild( document.createElement( 'DIV' ) ) ;
	if ( bShowLabel )
	{
		oField.className = 'SC_Field' ;
		oField.style.width = this.FieldWidth + 'px' ;
		oField.innerHTML = '<table width="100%" cellpadding="0" cellspacing="0" style="TABLE-LAYOUT: fixed;"><tbody><tr><td class="SC_FieldLabel"><label>&nbsp;</label></td><td class="SC_FieldButton">&nbsp;</td></tr></tbody></table>' ;

		this._LabelEl = oField.getElementsByTagName('label')[0] ;
		this._LabelEl.innerHTML = this.Label ;
	}
	else
	{
		oField.className = 'TB_Button_Off' ;
		//oField.innerHTML = '<span className="SC_FieldCaption">' + this.Caption + '<table cellpadding="0" cellspacing="0" style="TABLE-LAYOUT: fixed;"><tbody><tr><td class="SC_FieldButton" style="border-left: none;">&nbsp;</td></tr></tbody></table>' ;
		oField.innerHTML = '<table cellpadding="0" cellspacing="0" style="TABLE-LAYOUT: fixed;"><tbody><tr><td class="SC_FieldButton" style="border-left: none;">&nbsp;</td></tr></tbody></table>' ;
		
		// Gets the correct CSS class to use for the specified style (param).
		oField.innerHTML ='<table title="' + this.Tooltip + '" class="' + sClass + '" cellspacing="0" cellpadding="0" border="0">' +
				'<tr>' +
					//'<td class="TB_Icon"><img src="' + FCKConfig.SkinPath + 'toolbar/' + this.Command.Name.toLowerCase() + '.gif" width="21" height="21"></td>' +
					'<td class="TB_Text">' + this.Caption + '</td>' +
					'<td class="TB_ButtonArrow"><img src="' + FCKConfig.SkinPath + 'images/toolbar.buttonarrow.gif" width="5" height="3"></td>' +
				'</tr>' +
			'</table>' ;
	}


	// Events Handlers

	oField.SpecialCombo = this ;
	
	oField.onmouseover	= FCKSpecialCombo_OnMouseOver ;
	oField.onmouseout	= FCKSpecialCombo_OnMouseOut ;
	oField.onclick		= FCKSpecialCombo_OnClick ;
	
	FCKTools.DisableSelection( this._Panel.Document.body ) ;
}

function FCKSpecialCombo_OnMouseOver()
{
	if ( this.SpecialCombo.Enabled )
	{
		switch ( this.SpecialCombo.Style )
		{
		case FCK_TOOLBARITEM_ONLYICON :
			this.className = 'TB_Button_On';
			break ;
		case FCK_TOOLBARITEM_ONLYTEXT :
			this.className = 'TB_Button_On';
			break ;
		case FCK_TOOLBARITEM_ICONTEXT :
			this.className = 'SC_Field SC_FieldOver' ;
			break ;
		}
	}
}
	
function FCKSpecialCombo_OnMouseOut()
{
	switch ( this.SpecialCombo.Style )
	{
		case FCK_TOOLBARITEM_ONLYICON :
			this.className = 'TB_Button_Off';
			break ;
		case FCK_TOOLBARITEM_ONLYTEXT :
			this.className = 'TB_Button_Off';
			break ;
		case FCK_TOOLBARITEM_ICONTEXT :
			this.className='SC_Field' ;
			break ;
	}
}
	
function FCKSpecialCombo_OnClick( e )
{
	// For Mozilla we must stop the event propagation to avoid it hiding 
	// the panel because of a click outside of it.
//	if ( e )
//	{
//		e.stopPropagation() ;
//		FCKPanelEventHandlers.OnDocumentClick( e ) ;
//	}
	
	var oSpecialCombo = this.SpecialCombo ;

	if ( oSpecialCombo.Enabled )
	{
		var oPanel			= oSpecialCombo._Panel ;
		var oPanelBox		= oSpecialCombo._PanelBox ;
		var oItemsHolder	= oSpecialCombo._ItemsHolderEl ;
		var iMaxHeight		= oSpecialCombo.PanelMaxHeight ;
		
		if ( oSpecialCombo.OnBeforeClick )
			oSpecialCombo.OnBeforeClick( oSpecialCombo ) ;

		// This is a tricky thing. We must call the "Load" function, otherwise
		// it will not be possible to retrieve "oItemsHolder.offsetHeight".
		oPanel.Load( 0, this.offsetHeight, this ) ;

		if ( oItemsHolder.offsetHeight > iMaxHeight )
			oPanelBox.style.height = iMaxHeight + 'px' ;
		else
			oPanelBox.style.height = oItemsHolder.offsetHeight + 'px' ;
			
//		oPanel.PanelDiv.style.width = oSpecialCombo.PanelWidth + 'px' ;
		
		if ( FCKBrowserInfo.IsGecko )
			oPanelBox.style.overflow = '-moz-scrollbars-vertical' ;

		oPanel.Show( 0, this.offsetHeight, this ) ;
	}

	return false ;
}

/* 
Sample Combo Field HTML output:

<div class="SC_Field" style="width: 80px;">
	<table width="100%" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
		<tbody>
			<tr>
				<td class="SC_FieldLabel"><label>&nbsp;</label></td>
				<td class="SC_FieldButton">&nbsp;</td>
			</tr>
		</tbody>
	</table>
</div>
*/