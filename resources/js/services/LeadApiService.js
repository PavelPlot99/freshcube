import {BaseApiService} from "./BaseApiService.js";

const ServiceAction = {
    GET_LEADS: {
        url:'api/leads',
        method: 'GET',
    },

    SHOW_LEAD: {
        url:'api/leads/:id',
        method: 'GET',
    },

    LINK_CONTACT: {
        url:'api/leads/:id',
        method: 'POST',
    }
}

export class LeadApiService extends BaseApiService {
    async getLeads(params){
        return await this.buildRequest({
            ...ServiceAction.GET_LEADS,
            params
        })
    }

    async showLead(id){
        return await this.buildRequest({
            ...ServiceAction.SHOW_LEAD,
            queryParams: {id}
        })
    }

    async linkContact(id, data){
        return await this.buildRequest({
            ...ServiceAction.LINK_CONTACT,
            queryParams: {id},
            data: {...data}
        })
    }
}

const leadApiService = new LeadApiService()

export {
    leadApiService,
}