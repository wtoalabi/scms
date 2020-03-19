export default {
    setQueryOptions(state,options){
        console.log(options)
        let existing = state.queries.pagination.queryPagination;
        existing.sortDesc = options['sortDesc'][0];
        existing.sortBy = options['sortBy'][0];
        existing.itemsPerPage = options['itemsPerPage'];
        existing.page = options['page'];
        state.queries.pagination.queryPagination = existing;
    },
    setQueryPagination(state, payload){
        //let existing = state.queries.pagination.queryPagination;
        //state.queries.pagination.queryPagination = Object.assign(existing, payload)
    },
    setFilterByDate(state, payload){
        //let existing = state.queries.dateFilters['filterByDate'];
        //return state.queries.dateFilters['filterByDate'] = Object.assign(existing, payload);

    },
    setQuerySearchArray(state,payload){
        return state.queries.querySearch = payload
    },
    setQueryFilterByColumn(state,payload){
        //return state.queries.queryFilterByColumn.filterByColumn = payload
    },
    setQueryFilterByRelationship(state,payload){
        return state.queries.queryFilterByRelationship.filterByRelationship = payload
    },
    commitCustomFilter(state, payload){
        //return state.queries.customFilters = payload
    },
    resetQueryState(state){
        state.queries.pagination.queryPagination = {
            'sortBy': null,
            'page': 1,
        };
        state.queries.dateFilters.filterByDate = {};
        state.queries.querySearch = {};
        state.queries.queryFilterByColumn.filterByColumn = {};
        state.queries.queryFilterByRelationship.filterByRelationship = {};
        /*:{
            filterByRelationship:{}
        },*/
    },
}
