
function AfficherArticle()
{
//    alert("ok");

$.ajax
(
    {
        
        type:"get",
        url:"afficheArticle.php",
        data:"article="+$(".article").val(),
        success:function(data)
        {
            $('#divArticle').empty();
            $('#divArticle').append(data);
        },
        error:function()
        {
            alert("error");
        }
    }
 );  

}
