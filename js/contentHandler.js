function ContentHandler(methodName,handleCallback){
    var _=this;
    _.methodName=methodName;
    _.handleCallback=handleCallback;
    _.filter={
        order:null,
        orderby:null,
        where:{},
        page:0
    };
    _.totalPageDisplayer='.page-total';
    _.tatalCountDisplayr='.total-count';
    _.currentPageDiplayer='.page-now';

    _.setPage=function(page){
        _.filter.page=page;
    };
    _.setOrder=function(orderByField,asc){
        var order=asc?'asc':'desc';
        _.filter.orderby=orderByField;
        _.filter.order=order;
    };
    _.setNumber=function(number){
        _.filter.number=number;
    };
    _.addFilter=function(filter){
        if('object'==typeof(filter)){
            for(var i in filter){
                _.filter.where[i]=filter[i];
            }
        }
    };
    _.setfilter=function(filter){
        if('object'==typeof(filter))
            _.filter.where=filter;
    };
    _.getList=function (callback) {
        var sCallback=callback||_.handleCallback;
        if (_.methodName) {
            $.post('api.php/API/TableProvider/'+ _.methodName,_.filter,function(back){
                var backInf = backHandle(back);
                _.totalPage=parseInt(backInf.page);
                $(_.totalPageDisplayer).text(backInf.page);
                $(_.currentPageDiplayer).text(_.filter.page+1);
                //_.totalCount = backInf.count;
                sCallback(backInf.list);
            });
        }
    };
    _.setPageEvent=function(nextPageSelector,prevPageSelector,eventFunction){
        var sEventFunction=eventFunction||_.getList;
        var next=nextPageSelector||'#next';
        var prev=prevPageSelector||'#prev';
        $(document).on('click',next,function(){
            if(_.filter.where.page< _.totalPage-1){
                _.filter.where.page++;
                sEventFunction()
            }else{
                console.log('last')
            }
        });
        $(document).on('click',prev,function(){
            if(_.filter.where.page>0){
                _.filter.where.page--;
                sEventFunction()
            }else{
                console.log('first');
            }

        });
    };
        _.init=function(methodName,contentHangler){
        _.methodName=methodName;
        _.handleCallback=contentHangler;
    }

}