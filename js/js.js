// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});

function lo(x)
{
	location.replace(x)
}

function op(x,y,url)
{
	$(x).fadeIn()
	if(y)
	$(y).fadeIn()
	if(y&&url)
	$(y).load(url)
}

function cl(x)
{
	$(x).fadeOut();
}

/**
 * 刪除功能
 * @param {string} table 資料表名稱 (對應 api/${table}.php)
 * @param {number} id 要刪除的資料 ID
 */
function del(table, id) {
    if (confirm("確定要刪除這筆資料嗎？刪除後將無法恢復。")) {
        $.post(`./api/${table}.php?action=del`, { id }, function() {
            location.reload();
        });
    }
}
