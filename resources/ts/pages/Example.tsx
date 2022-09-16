import React from 'react';
import ReactDOM from 'react-dom';
import { Button } from '@material-ui/core';

function Example() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>
                        <h1>Success React Router!</h1>
                        <div className="card-body">I'm an example component!</div>
                        <Button href={`/`} color="primary" variant="contained">material ui</Button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;