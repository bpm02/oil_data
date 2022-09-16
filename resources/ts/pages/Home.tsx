import { Button, Card } from '@material-ui/core';

import { OilDataInterface } from '../interfaces/app_interfaces';
import Stocks from '../components/Stocks';
// https://react-chartjs-2.netlify.app/examples/vertical-bar-chart

/**
 * 
 * axios
 * display
 * @returns 
 */
function Home() {


    return (
        <div className="container">
            {/*
            <Card>
                <Button color="primary" variant="contained" href={`/example`}>Exampleに遷移</Button>
    </Card>*/}
            <Stocks />

        </div>
    );

}



export default Home;
