import React from 'react';

const ButtonLogout = (props) => {
    return ( 
        <div className="d-flex justify-content-center mt-2">
            <a href="{{path('account_logout')}}"><button className="btn btn-warning shadow">Se déconnecter</button></a>
        </div>
    );
}
 
export default ButtonLogout;