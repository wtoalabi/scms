<script>
    import {scrollToTop} from '../helpers'
  export default {
    data() {
      return {
        descending: true,
        sortBy: ""
      }
    },
    methods: {
      paginateRequest(event){
       scrollToTop();
        let pagination = this.flipDescendant(event.pagination);
        pagination['paginate'] = true;
        pagination = this.setCustomDirection(pagination);
        this.$store.commit("setQueryPagination", pagination);
        let data = this.$store.state.mergeAllQueries();
        this.form = data;
        let pageNumber = this.$store.state.queries.pagination.queryPagination.page;
        let suffix = pageNumber === 1 ? '' : `?page=${pageNumber}`;
        this.makeRequest(`${this.listUrl}${suffix}`,{
            action:'post', mutator: this.mutator,
            store:this.$store,
            showResponseMessage:false
          }
        );
      },
      flipDescendant(pagination){
        if(this.sortBy && this.sortBy === pagination.sortBy){
          pagination.descending = !this.descending;
        }
        this.sortBy = pagination.sortBy;
        this.descending = pagination.descending;
        return pagination;
      },
      setCustomDirection(pagination){
        pagination['sortDirection'] = this.descending ? "desc" : "asc";
        return pagination;
      },
    },
    computed: {
      pagination:{
        get: function () {
          let pagination = this.$store.state.queries.pagination.queryPagination
          if(_.isNotEmpty(pagination)) {
            return {
              sortBy: this.sortBy,
              descending: this.descending,
              page: pagination.page,
              rowsPerPage: pagination.rowsPerPage,
              rowsNumber: this.rowsNumber,
            }
          }
        },
        set: function (v) {
        }
      },
    }
  }

</script>
