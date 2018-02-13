// JavaScript Document
function startTime()
{
var tm=new Date();
var h=tm.getHours();
var m=tm.getMinutes();
var s=tm.getSeconds();
m=checkTime(m);
s=checkTime(s);
document.getElementById('time').innerHTML=h+":"+m+":"+s;
//document.getElementById('date_now').innerHTML=new Date();
t=setTimeout('startTime()',1000);
}
function checkTime(i)
{
if (i<10)
{
i="0" + i;
}
return i;
}
