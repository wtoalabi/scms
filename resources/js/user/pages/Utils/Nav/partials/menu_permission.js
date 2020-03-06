export default {
    methods: {
        /*We are looking for if any of the items in the incoming permits array
        * is within the list of the admin's permissions.
        * The difference between all permissions and permits array is a difference between between
        * the two arrays.
        * If the difference is less than the permissions total, then the admin/user has permission, it returns true.
        * Imagine all permissions array look like:
        * let permissions = [1,2,3,4,5]
        * let permits = [1,2]
        * Then the difference will br [3,4,5]
        * Obviously, the difference is less than the total original number of all permissions.
        * Hence, we return true...the admin, can view the menu.
        * if however, any of the permit items cant be found within the permissions list, then the difference will return:
        * [1,2,3,4,5], the exact total items within the permissions...
        * and when checking, the two would be equal, and return false. */

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
          return this.$store.state.user.role.permissions;
        }
    }
}
