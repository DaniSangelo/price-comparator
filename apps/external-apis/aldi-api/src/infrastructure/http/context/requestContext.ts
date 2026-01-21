import asyncHooks from "node:async_hooks";
const { AsyncLocalStorage } = asyncHooks;

type RequestContext = {
    requestId: string;
    hostName: string;
}

export const requestContext = new AsyncLocalStorage<RequestContext>();

export function getRequestContext() {
    const a = requestContext.getStore();
    if(a) {
        return a;
    }
    return { requestId: '', hostName: '' };
}