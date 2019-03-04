   function myCheck()
            {
               for(var i=0;i<document.form.elements.length-1;i++)
               {
                  if(document.form.elements[i].value=="")
                  {
                     alert("未填入学院班级！");
                     document.form.elements[i].focus();
                     return false;
                  }
               }
               return true;
              

}   

   function myCheck1()
            {
               for(var i=0;i<document.form1.elements.length-1;i++)
               {
                  if(document.form1.elements[i].value=="")
                  {
                     alert("未填入学院班级！");
                     document.form1.elements[i].focus();
                     return false;
                  }
               }
               return true;
              

}  
   function myCheck2()
            {
               for(var i=0;i<document.form2.elements.length-1;i++)
               {
                  if(document.form2.elements[i].value=="")
                  {
                     alert("未填入学院班级！");
                     document.form2.elements[i].focus();
                     return false;
                  }
               }
               return true;
              

}  
 function myCheck3()
            {
               for(var i=0;i<document.form3.elements.length-1;i++)
               {
                  if(document.form3.elements[i].value=="")
                  {
                     alert("未输入年份或月份！");
                     document.form3.elements[i].focus();
                     return false;
                  }
               }
               return true;
              

}  function myCheck4()
            {
               for(var i=0;i<document.form4.elements.length-1;i++)
               {
                  if(document.form4.elements[i].value=="")
                  {
                     alert("未输入学号！");
                     document.form3.elements[i].focus();
                     return false;
                  }
               }
               return true;
              

}  