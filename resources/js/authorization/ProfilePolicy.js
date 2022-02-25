export default class ProfilePolicy
{
    static create(user)
    {
        return user.is_admin;
    }

    static view(user, profile)
    {
        //return true;
        return user.is_admin;
    }

    static delete(user, profile)
    {
        return user.is_admin;
    }

    static update(user, profile)
    {
        return user.is_admin;
    }
}