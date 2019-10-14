$(function(){
    $('body').on('click', 'table[class*=table-sort] > tbody > tr > th:gt(0)' , function() {
        var orderby = $(this).attr('orderby');
        var sort = $(this).attr('sort');
        if (sort && orderby ){
            sort = sort == 'asc' ? 'desc' : 'asc';
            $('#orderby').val(orderby);
            $('#sort').val(sort);
            $("#search_form").submit();
        }
    });
});
window.onload = function(){
    //保持高度一致,修复样式问题
    var maxH=0;
    var divList = document.getElementsByClassName('J_equal_height');
    for(var i=0;i<divList.length;i++){
        var h = divList[i].clientHeight;
        if(h>maxH)maxH =h;
    }
    for(var i=0;i<divList.length;i++){
        divList[i].style.height = maxH+'px';
    }
};