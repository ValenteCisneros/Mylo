import{Client, Account} from "appwrite";

const client = new Client()
    .setEndpoint('https://cloud.appwrite.io/vl')
    .setProject('6671e86f00295f146648');
const account = new Account(client)

export {client, account};