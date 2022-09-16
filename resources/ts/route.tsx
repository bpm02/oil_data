import React from 'react';
import ReactDOM from 'react-dom';
import {
    BrowserRouter as Router,
    Routes,
    Route,
    Navigate,
} from 'react-router-dom';
import Example from './pages/Example';
import Home from './pages/Home';

function App() {
    return (
        <div>
            <Routes>
                <Route path='/' element={<Home />} />
                {/*<Route path='/example' element={<Example />} />*/}
            </Routes>

        </div>
    );
}

ReactDOM.render((
    <Router>
        <App />
    </Router>
), document.getElementById('app'))
