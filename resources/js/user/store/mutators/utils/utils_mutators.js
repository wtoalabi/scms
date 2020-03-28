import Route from '../../../router'
let state = "";
let breadcrumbs = [];
let allBreadcrumbsMap = {};
export default {
    async commitBreadcrumbs(incomingState, payload) {
        state = incomingState;
        allBreadcrumbsMap = state.breadcrumbs.map;
        await addDashboardToBreadcrump();
        await addRouteParentsToBreadcrumbs(payload.parents);
        await addCurrentRouteToBreadcrumb(payload.id);
        state.breadcrumbs.list = breadcrumbs;
    },

    updateBreadcrumb(state, payload) {
        let crumbs = state.breadcrumbs.list;
        crumbs.map(c => {
            if (c.text === payload.crumb) {
                c.text = payload.replacement;
            }
            return c;
        });
    }
}

async function updateCrumbs(crumb,option = {disable: false}) {
    breadcrumbs.push({
        text: crumb.name,
        href: crumb.url,
        disabled: option.disable
    });
    return breadcrumbs;
}
async function addDashboardToBreadcrump() {
    breadcrumbs = [];
    breadcrumbs.push(state.breadcrumbs.dashboard);
}

async function addRouteParentsToBreadcrumbs(parents) {
    if (_.isNotEmpty(parents)) {
        for (const parent of parents) {
            let crumb = allBreadcrumbsMap[parent];
            breadcrumbs = await updateCrumbs(crumb);
        }
    }
}

async function addCurrentRouteToBreadcrumb(payloadID) {
    let crumb = allBreadcrumbsMap[payloadID];
    breadcrumbs = await updateCrumbs(crumb, {disable: true});
}
