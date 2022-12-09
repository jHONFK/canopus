import Cookie from 'js-cookie';

export default{
    
    redirectIfAuthenticated: (to, from, next) => {
        const token = Cookie.get('token');
        if (token) {
            next({name:'carousels'});
        }
        
        next();
        
    }
}