/*******************
 * formvalidation.js
 *
 * for checking common form field types
 */
 
/**
 * isNotEmpty(elem)
 *
 * modified from "Javascript & DHTML Cookbook" (Publisher: O'Reilly)
 */
function isNotEmpty(elem, useAlert)
{
  var str = elem.value;
  var re = /.+/;
  str = str.toString();
  if(!str.match(re))
  {
    if(useAlert)
    {
      alert("Please fill in the required field");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }
    return false;
  }
  return true;
}

/**
 * isPassword(elem)
 *
 * modified from "Javascript & DHTML Cookbook" (Publisher: O'Reilly)
 */
function isPassword(elem, useAlert)
{
  var confirm = $("userform_passwordconfirm").value;
  var str = elem.value;
  var re = /.{8,}/;
  str = str.toString();
  confirm = confirm.toString();
  if(!str.match(re))
  {
    if(useAlert)
    {
      alert("Passwords must be at least 8 characters long");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }
    return false;
  }
  if(str!=confirm)
  {
    if(useAlert)
    {
      alert("Password confirmation doesn't match.  Please verify password.");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }
    return false;
  }
  return true;
}

/**
 * isEmailAddr
 *
 * modified from "Javascript & DHTML Cookbook" (Publisher: O'Reilly)
 */
function isEmailAddr(elem,useAlert)
{
  var str = elem.value;
  var re= /^[\w-]+(?:\.[\w-])*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/;
  if(!str.match(re))
  {
    
    if(useAlert)
    {
      alert("Verify the email address format");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }

    return false;
  }
  else
  {
    return true;
  }
}

/**
 * isNumber(elem)
 *
 * modified from "Javascript & DHTML Cookbook" (Publisher: O'Reilly)
 */
function isNumber(elem, useAlert)
{
  var str = elem.value;
  var re = /^[-]?\d*\.?\d*$/;
  str = str.toString();
  if(!str.match(re))
  {
    if(useAlert)
    {
      alert("Enter only numbers into the field");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }
    return false;
  }
  return true;
}

/**
 * isZipCode(elem)
 *
 */
function isZipCode(elem, useAlert)
{
  var str = elem.value;
  var re = /^\d{5}(-\d{4})?$/;
  str = str.toString();
  if(!str.match(re))
  {
    if(useAlert)
    {
      alert("Check the zipcode formatting");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }

    return false;
  }
  return true;
}

/**
 * isTelephoneNumber(elem)
 *
 */
function isTelephoneNumber(elem, useAlert)
{
  var str = elem.value;
  var re = /^\(\d{3}\)\s*\d{3}[-]\d{4}$|^\d{3}[\s-\.]{0,1}\d{3}[\s-\.]{0,1}\d{4}$/;
  str = str.toString();
  if(!str.match(re))
  {
    if(useAlert)
    {
      alert("Check the telephone formatting");
      setTimeout("focusElement('" +elem.form.name + "', '" + elem.name + "')", 0);
    }
    
    return false;
  }
  return true;
}

/**
 * focusElement(formName, elemName)
 *
 * @param string formName the containing form
 * @param string elemName the element in question
 * 
 * used after finding an invalid textfield element in a form to bring focus on it and select
 * all the text in the field
 */
function focusElement(formName, elemName)
{
  var elem=document.forms[formName].elements[elemName];
  elem.focus();
  elem.select();
}