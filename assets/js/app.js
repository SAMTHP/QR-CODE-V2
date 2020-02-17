// Les imports importants
import React from 'react';
import ReactDom from 'react-dom';
import '../css/app.css';
import Navbar from './components/Navbar';
import HomePage from './pages/HomePage';
import ButtonLogout from './components/ButtonLogout';
import {HashRouter, Switch, Route} from "react-router-dom";
import TeamJumbotron from './components/TeamJumbotron';

const App = () => {
    return (
        <HashRouter>
            <Navbar/>
            <main className="container pt-5">
                <Switch>
                    <Route path="/team" component={TeamJumbotron}/>
                    <Route path="/" component={HomePage}/>
                </Switch>
                <ButtonLogout/>
            </main>
        </HashRouter>
    );
}

const rootElement = document.querySelector('#app');
ReactDom.render(<App />, rootElement)