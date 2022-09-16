import React from 'react';
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
} from 'chart.js';
import { Bar } from 'react-chartjs-2';


ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend
);



const DisplayChart = (props: any) => {

    let label_name: string = props.product + ' ' + props.area;

    let options = {
        responsive: true,
        plugins: {
            legend: {
                position: 'top' as const,
            },
            title: {
                display: true,
                text: props.product,
            },
        },
    };


    let labels = props.period;
    let data = {
        labels,
        datasets: [
            {
                label: label_name,
                data: props.data,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
            }
        ],
    };

    return (
        <>
            <Bar options={options} data={data} />
        </>
    )
}

export default DisplayChart;
