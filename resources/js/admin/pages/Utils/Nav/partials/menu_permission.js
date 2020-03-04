export default {
    methods: {
        groupPermission(permits) {
            if (this.permissions) {
                let permissions = this.permissions;
                let difference = _.difference(permissions, permits);
                return difference.length < permissions.length;
            }
        },
        userCan(permission) {
            let allPermissions = this.permissions;
            if (allPermissions) {
                return allPermissions.includes(permission);
            }
        },
    },
    computed:{
        permissions(){
            return this.$store.state.admin.role.permissions;
        }
    }
}
