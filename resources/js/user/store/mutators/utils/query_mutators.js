export default {
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
        //return state.queries.queryFilterByRelationship.filterByRelationship = payload
    },
    commitCustomFilter(state, payload){
        //return state.queries.customFilters = payload
    },
    resetQueryState(state){
        state.queries.pagination.queryPagination = {
            'sortBy': null,
            'page': 1,
            'rowsPerPage': 12,
        };
        state.queries.dateFilters.filterByDate = {};
        state.queries.querySearch = {};
        state.queries.queryFilterByColumn.filterByColumn = {};
    },
}
