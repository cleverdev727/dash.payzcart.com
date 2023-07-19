let className = null;
function setPaginateButton(_eventName,PaginateData,postData) {
    className = _eventName;
    let half_total_links = Math.floor(PaginateData.link_limit / 2);
    PaginateData.from = (PaginateData.current_page - half_total_links) < 1 ? 1 : PaginateData.current_page - half_total_links;
    PaginateData.to = (PaginateData.current_page + half_total_links) > PaginateData.last_page ? PaginateData.last_page : (PaginateData.current_page + half_total_links);
    if (PaginateData.from > PaginateData.last_page - PaginateData.link_limit) {
        PaginateData.from = (PaginateData.last_page - PaginateData.link_limit) + 1;
        PaginateData.to = PaginateData.last_page;
    }
    if (PaginateData.to <= PaginateData.link_limit) {
        PaginateData.from = 1;
        PaginateData.to = PaginateData.link_limit < PaginateData.last_page ? PaginateData.link_limit : PaginateData.last_page;
    }

    let paginateHtml = '';
    if(PaginateData.last_page > 1) {
        paginateHtml = `
            <ul class="custom-pagination">
                 <li class="${PaginateData.current_page === 1 ? 'disabled' : ''}">
                    ${PaginateData.current_page === 1 ? ' <label class="disabled"> << </label>' : '<a href="javascript:setPageNO(1);"> << </a>'}
                 </li>
                 <li class="${PaginateData.current_page === 1 ? 'disabled' : ''}">
                    ${ (PaginateData.current_page > PaginateData.last_page || PaginateData.current_page - 1 === 0) ? '<label class="disabled">Prev</label>' : '<a href="javascript:setPageNO('+(PaginateData.current_page - 1 )+');" >Prev</a>'}
                 </li>
                 ${linkLimit(PaginateData)}
                 <li class="${PaginateData.current_page === PaginateData.last_page ? 'disabled' : ''}">
                    ${ PaginateData.current_page === PaginateData.last_page ? '<label class="disabled">Next</label>' : '<a href="javascript:setPageNO('+(PaginateData.current_page + 1 )+ ');">Next</a>' }
                 </li>
                 <li class="${PaginateData.current_page === PaginateData.last_page ? 'disabled' : ''}">
                    ${PaginateData.current_page === PaginateData.last_page ? '<label class="disabled"> >> </label>' : '<a href="javascript:setPageNO('+(PaginateData.last_page)+ ');"> >> </a>' }
                 </li>
            </ul>
            <span class="d-none d-md-block custom-pagination-counter" style="float: left;"> Showing <strong>${((PaginateData.current_page - 1) * postData.limit) + 1 }</strong>  to <strong> ${((PaginateData.current_page - 1) * postData.limit) + PaginateData.current_item_count}</strong>  of <strong> ${PaginateData.total} </strong>  entries</span>
        `;
    }
    $('#pagination').html(paginateHtml);
}


function linkLimit(PaginateData) {
    var html = '';
    var i;
    for(i = PaginateData.from; i <= PaginateData.to; i++){
        html += `<li class="${PaginateData.current_page === i ? 'active' : '' }" style="cursor: pointer;"><a onclick="setPageNO(${i});">${i}</a></li>`
    }
    return html;
}

function setPageNO(pageNO) {
    EventListener.emitter({e: className, c: {page_number : pageNO}});
}
