import React from 'react';

const imgStyle = {
    width: '50%'
};

const HomePage = (props) => {
    return ( 
        <div className="row pt-5">
            <div className="col-xs-6 col-md-6 shadow bg-secondary">
                <h1 className="text-white text-center">Administration</h1>
                <hr/>
                <a href="{{path('easyadmin')}}">
                    <div className="d-flex justify-content-center py-4">
                        <img src="/img/admin.png" alt="" style={imgStyle}/>
                    </div>
                </a>
            </div>
            <div className="col-xs-6 col-md-6 shadow bg-warning">
                <h1 className="text-white text-center">API</h1>
                <hr/>
                <a href="{{path('api_entrypoint')}}">
                    <div className="d-flex justify-content-center py-4">
                        <img src="/img/api.png" alt="" style={imgStyle}/>
                    </div>
                </a>
            </div>
        </div>
    );
}
 
export default HomePage;