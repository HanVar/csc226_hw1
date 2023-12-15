import React from 'react';
import logo from './logo.svg';
import './App.css';
import MyComponent from "./components/Testcomponent";

function App() {
    return (
        <div className="App">
            <header className="App-header">
                <img src={logo} className="App-logo" alt="logo" />
                <MyComponent></MyComponent>
            </header>
        </div>
    );
}

export default App;