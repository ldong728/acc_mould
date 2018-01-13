var TableController = {
    totalPageDisplayer: '.page-total',
    tatalCountDisplayr:'total-count',
    currentPageDiplayer:'.page-now',
    totalPage:0,
    methodName:null,
    handleCallback:null,
    filter:{
        order:null,
        orderby:null,
        where:{},
        page:0
    },


    setPage:function(page){
        this.filter.page=page;
    },
    setOrder:function(orderByField,asc){
      var order=asc?'asc':'desc';
        this.filter.orderby=orderByField;
        this.filter.order=order;
    },
    setNumber:function(number){
      this.filter.number=number;
    },
    addFilter:function(filter){
        if('object'==typeof(filter)){
            for(var i in filter){
                this.filter.where[i]=filter[i];
            }
        }
    },
    setfilter:function(filter){
        if('object'==typeof(filter))
        this.filter.where=filter;
    },
    getList: function (callback) {
        //console.log('getList');
        var sCallback=callback||this.handleCallback;
        //console.log()
        //console.log(sCallback);
        var _=this;
        if (this.methodName) {
            ajaxPost(this.methodName, this.filter, function (back) {
                var backInf = backHandle(back);
                _.totalPage=parseInt(backInf.page);
                $(_.totalPageDisplayer).text(backInf.page);
                $(_.currentPageDiplayer).text(_.filter.page+1);
                //_.totalCount = backInf.count;
                console.log(backInf);
                sCallback(backInf);
            });
        }
    },
    prepareElement:function(){
        var returnData={};
        var classList=[];
        var outArg=arguments;
        $.each(arguments,function(k,v){
            //console.log(v);
            if($(v.toString()).length>0){
                returnData[v]=$(v).clone();
            }
            classList.push(v);
        });

        $.each(classList,function(k,v){
            $(v).remove();
            for(var i in returnData){
                returnData[i].find(v).remove();
            }
        });
        return function(jqueryElement){
            var element=jqueryElement;
            if(1==outArg.length){
                element=outArg[0];
            }
            return returnData[element].clone();
        }
    },




    setPageEvent:function(nextPageSelector,prevPageSelector,eventFunction){
        var _=this;
        var sEventFunction=eventFunction||_.getList;
        var next=nextPageSelector||'#next';
        var prev=prevPageSelector||'#prev';
        $(document).on('click',next,function(){
            //console.log(_.totalPage);
            //console.log(_.filter.page);
           if(_.filter.page< _.totalPage-1){
               _.filter.page++;
               _.getList(eventFunction);
               //sEventFunction(_.handleCallback);
           }else{
               console.log('last')
           }
        });
        $(document).on('click',prev,function(){
           if(_.filter.page>0){
               _.filter.page--;
               _.getList(eventFunction);
               //sEventFunction(_.handleCallback);
           }else{
               console.log('first');
           }

        });
    },
    init:function(methodName,contentHangler){
        this.methodName=methodName;
        this.handleCallback=contentHangler;
    }
    //normalHandler:function(data)

};
//TableController.init();