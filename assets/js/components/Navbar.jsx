import React from 'react';

const Navbar = (props) => {
    return ( 
        <nav className="navbar navbar-expand-lg navbar-light bg-light shadow">
            <a className="navbar-brand" href="/">QR-CODE-APP</a>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
            </button>

            <div className="collapse navbar-collapse" id="navbarColor03">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <a className="nav-link" href="/admin">Administration <span className="sr-only">(current)</span></a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="/api">ApiPlatform</a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="/#/team">TEAM</a>
                    </li>
                </ul>
            </div>
        </nav>
    );
}
 
export default Navbar;