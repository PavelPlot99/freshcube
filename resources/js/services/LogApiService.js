import {BaseApiService} from "./BaseApiService";
import {LeadApiService} from "./LeadApiService";

const ServiceAction = {
    GET_LOGS: {
        url:'api/logs',
        method: 'GET',
    },
}

export class LogApiService extends BaseApiService {
    async getLogs(){
        return await this.buildRequest({
            ...ServiceAction.GET_LOGS,
        })
    }
}


const logApiService = new LogApiService()

export {
    logApiService,
}