import Index from './components/Index'
import Register from './components/Register'
import Login from './components/Login'

const routes = [,
{
    path: '/',
    component: Index,
    name: 'Index',
    redirect: '/register',
    children: [
        {
            path: '/register',
            component: Register,
        },
        {
            path: '/login',
            component: Login,
        }
    ]
}
];

export default routes;