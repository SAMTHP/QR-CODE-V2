import React from 'react';

const TeamJumbotron = (props) => {
    return ( 
        <div className="jumbotron shadow">
            <h1 className="display-4">Gestion des PDF</h1>
            <p className="lead">Application développée dans le cadre d'un projet en équipe</p>
            <hr className="my-4"/>
            <div className="list-group shadow">
                <button type="button" className="list-group-item list-group-item-action active">
                    TEAM
                </button>
                <a type="button" href="https://github.com/pittoul" className="list-group-item list-group-item-action">Bruno</a>
                <a type="button" href="https://github.com/pittoul" className="list-group-item list-group-item-action">Alec</a>
                <a type="button" href="https://github.com/SAMTHP" className="list-group-item list-group-item-action">Samir</a>
                <a type="button" href="https://github.com/Aotsukii" className="list-group-item list-group-item-action">Elie</a>
                <a type="button" href="https://github.com/Epradillon" className="list-group-item list-group-item-action">Etienne</a>
            </div>
            <div className="row d-flex justify-content-center">
                <a className="btn btn-success btn-lg mt-2 shadow col-xs-12 col-md-3" href="https://github.com/SAMTHP/QR-CODE-V2" role="button">Lien GitHub</a>
            </div>
            
        </div>
    );
}
 
export default TeamJumbotron;