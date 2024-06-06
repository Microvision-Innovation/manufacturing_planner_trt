
function GetXmlHttpObject(handler)
{
   var objXMLHttp=null
   if (window.XMLHttpRequest)
   {
       objXMLHttp=new XMLHttpRequest()
   }
   else if (window.ActiveXObject)
   {
       objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
   }
   return objXMLHttp
}
function stateChanged()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}
// Will populate data on the list box from based on the drop down selection
function htmlData(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged;
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
}

// Will the sms list selected
function htmlDatas(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("myAlert").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

//script for populating the list boxes moving data from one list box to another
function SelectMoveRows(SS1,SS2)
{
    var SelID='';
    var SelText='';
    // Move rows from SS1 to SS2 from bottom to top
    for (i=SS1.options.length - 1; i>=0; i--)
    {
        if (SS1.options[i].selected == true)
        {
            SelID=SS1.options[i].value;
            SelText=SS1.options[i].text;
            var newRow = new Option(SelText,SelID);
            SS2.options[SS2.length]=newRow;
            SS1.options[i]=null;
        }
    }
    SelectSort(SS2);
}
function SelectSort(SelList)
{
    var ID='';
    var Text='';
    for (x=0; x < SelList.length - 1; x++)
    {
        for (y=x + 1; y < SelList.length; y++)
        {
            if (SelList[x].text > SelList[y].text)
            {
                // Swap rows
                ID=SelList[x].value;
                Text=SelList[x].text;
                SelList[x].value=SelList[y].value;
                SelList[x].text=SelList[y].text;
                SelList[y].value=ID;
                SelList[y].text=Text;
            }
        }
    }
}

function htmlData2(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult2").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged2;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

function stateChanged2()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult2").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }
}


function htmlData3(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult3").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged3;
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
}

function stateChanged3()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult3").innerHTML= xmlHttp.responseText;


   }
   else {
           //alert(xmlHttp.status);
   }
}

function htmlData4(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult4").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged4;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

function stateChanged4()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult4").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }

}

function htmlData5(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult5").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged5;
   xmlHttp.open("GET",url,true) ;
   xmlHttp.send(null);
}

function stateChanged5()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult5").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }

}
function htmlData6(url, qStr)
{
   if (url.length==0)
   {
       document.getElementById("txtResult6").innerHTML="";
       return;
   }
   xmlHttp=GetXmlHttpObject()
   if (xmlHttp==null)
   {
       alert ("Browser does not support HTTP Request");
       return;
   }
   url=url+"?"+qStr;
   url=url+"&sid="+Math.random();
   xmlHttp.onreadystatechange=stateChanged6;
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
}

function stateChanged6()
{
   if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
   {
           document.getElementById("txtResult6").innerHTML= xmlHttp.responseText;
   }
   else {
           //alert(xmlHttp.status);
   }

}
function htmlData7(url, qStr)
{
    if (url.length==0)
    {
        document.getElementById("txtResult7").innerHTML="";
        return;
    }
    xmlHttp=GetXmlHttpObject()
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
    url=url+"?"+qStr;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange=stateChanged7;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChanged7()
{
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
        document.getElementById("txtResult7").innerHTML= xmlHttp.responseText;
      //  $("#constituency").change();
    }
    else {
        //alert(xmlHttp.status);
    }
}

function htmlData8(url, qStr)
{

    if (url.length==0)
    {
        document.getElementById("txtResult8").innerHTML="";
        return;
    }
    xmlHttp=GetXmlHttpObject()
    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
    url=url+"?"+qStr;
    url=url+"&sid="+Math.random();
    xmlHttp.onreadystatechange=stateChanged8;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);
}

function stateChanged8()
{

    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
        document.getElementById("txtResult8").innerHTML= xmlHttp.responseText;
      //  $("#constituency").change();
    }
    else {
        //alert(xmlHttp.status);
    }
}