import ProfilePolicy from './ProfilePolicy';

export default class Gate
{
    constructor(user)
    {
        this.user = user;

        this.policies = {
            profile: ProfilePolicy
        };
    }

    before()
    {
        return this.user.is_admin;
    }

    allow(action, type, model = null)
    {
        if (this.before()) {
            return true;
        }

        return this.policies[type][action](this.user, model);
    }

    deny(action, type, model = null)
    {
        return ! this.allow(action, type, model);
    }
}