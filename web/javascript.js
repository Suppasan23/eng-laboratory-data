window.addEventListener("load",showData("all"));

let header = document.getElementById("myButton");


let btnsA = header.getElementsByClassName("btnA");
btnsA[0].addEventListener("click", function()
{
    let current = header.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");

    this.className += " active";

   showData(this.value)
})


let btns = header.getElementsByClassName("btn");
for (let i = 0; i < btns.length; i++) 
{
  btns[i].addEventListener("click", function()
  {
    let current = header.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");

    this.className += " active";

    showData(this.value)
  });
}


function showData(str)
{
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200) 
      {
        document.getElementById("data").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "getdata.php?q=" + str, true);
    xmlhttp.send();
}

document.getElementById("additem").addEventListener("click",function()
{
  window.open('add.php', "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=600,height=400");
})
