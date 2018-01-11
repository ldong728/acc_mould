function ContentHandler(methodName,handleCallback,elementTemplate,contentContainer){
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
    _.prepareElement=function(){
        var returnData={};
        var classList=[];
        var outArg=arguments;
        $.each(arguments,function(k,v){
            if($(v.toString()).length>0){
                returnData[v]=$(v).clone();
            }
            classList.push(v);
        });
        console.log(returnData);
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
    };
    _.elementProvider=elementTemplate?_.prepareElement(elementTemplate):null;
    _.elementContainer=contentContainer?$(contentContainer.toString()):$(elementTemplate).parent();
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
                if(_.elementProvider){
                    console.log('elementProvider');
                    _.elementContainer.empty();
                    console.log(_.elementContainer);
                    $.each(backInf.list,function(k,v){
                        var element = _.elementProvider();
                        element.find('.content').each(function(id,subElement){
                            var localName=subElement.localName;
                            var field=$(subElement).data('field');
                            switch(localName){
                                case 'input':
                                    $(subElement).val(v[field]);
                                    break;
                                case 'img':
                                    $(subElement).attr('scr',v[field]);
                                    break;
                                default :
                                    $(subElement).text(v[field]);
                                    break;
                            }
                            $(subElement).removeAttr('data-field');
                        });
                        _.elementContainer.append(element);
                    });
                }
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
    };


}