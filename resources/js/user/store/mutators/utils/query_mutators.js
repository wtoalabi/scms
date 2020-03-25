export default {
    setQueryOptions(state, options) {
        let itemsPerPage = options['itemsPerPage'];
        let response = false;
        let existing = state.queries.pagination.queryPagination;
        existing.sortDesc = options['sortDesc'][0];
        existing.sortBy = options['sortBy'][0];
        if (existing.sortBy === 'name') {
            existing.sortBy = 'last_name'
        }
        if (itemsPerPage === -1) {
            if (existing.rowsNumber > 100) {
                response = confirm(`Are you sure? Showing ${existing.rowsNumber} items might cause some performance drag. Still want to continue`)
                response ? existing.itemsPerPage = existing.rowsNumber : null;
            } else {
                existing.itemsPerPage = existing.rowsNumber;
            }
        } else {
            existing.itemsPerPage = itemsPerPage;
        }
        existing.page = options['page'];
        state.queries.pagination.queryPagination = existing;
    },
    setQueryPagination(state, payload) {
        //let existing = state.queries.pagination.queryPagination;
        //state.queries.pagination.queryPagination = Object.assign(existing, payload)
    },
    setFilterByDate(state, payload) {
        state.queries.pagination.queryPagination.sortBy = 'dateAdded';
        state.queries.pagination.queryPagination.sortDesc = false;
        let existing = state.queries.dateFilters['filterByDate'];
        return state.queries.dateFilters['filterByDate'] = Object.assign(existing, payload);

    },
    setQuerySearchArray(state, payload) {
        let searchValue = payload.searchMultipleColumns[1];
        if (searchValue && searchValue.length >= 2 && Number.parseInt(searchValue)) {
            state.queries.queryFilterByRelationship.filterByRelationship = [['phones', 'number', searchValue]]
            state.queries.querySearch = {}
        } else {
            return state.queries.querySearch = payload
        }
    },
    setQueryFilterByColumn(state, payload) {
        return state.queries.queryFilterByColumn.filterByColumn = payload
    },
    setQueryFilterByBirthday(state, payload) {
        return state.queries.queryFilterByColumn.filterByBirthday = payload
    },
    setQueryFilterByRelationship(state, payload) {
        return state.queries.queryFilterByRelationship.filterByRelationship = payload
    },
    commitCustomFilter(state, payload) {
        //return state.queries.customFilters = payload
    },
    resetQueryState(state) {
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
    resetSearchQueries(state){
        state.queries.querySearch = {};
        state.queries.queryFilterByRelationship.filterByRelationship = []
    }
}
