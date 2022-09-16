import useAxios from "../hooks/useAxios";
import axios from '../apis/oilStocks';
import { useState } from 'react';
import {
    FormControl,
    FormGroup,
    FormControlLabel,
    Checkbox,
    Radio,
    FormLabel,
    RadioGroup
} from '@material-ui/core';

import Grid from '@material-ui/core/Grid'

import DisplayList from "./listLoop";
import DisplayChart from "./DisplayChart";

const productName: { [key: string]: string } = {
    EPC0: 'Crude Oil',
    EPD0: 'Distillate Fuel Oil',
    EPM0: 'Total Gasoline',
}

const translateName = ($arg: string): string => {
    let result: string = ''
    for (const key in productName) {

        if (productName[key] == $arg) {
            console.log(`result ${result} product name ${productName[key]}`)
            result = productName[key];
            break;
        }
    }
    console.log(result)
    return result
}

/**
 * 
 * @returns 
 * displaycahrtに複数のデータを渡せば一つのグラフに複数のデータを表示可能
 * 
 * 
 */

const Stocks = () => {

    const [label1, setlabel1] = useState(false)
    const [label2, setlabel2] = useState(false)
    const [label3, setlabel3] = useState(false)
    const [label4, setlabel4] = useState(false)
    const [label5, setlabel5] = useState(false)
    const [label6, setlabel6] = useState(false)
    const [label7, setlabel7] = useState(false)
    const [label8, setlabel8] = useState(false)
    const [label9, setlabel9] = useState(false)
    const [label10, setlabel10] = useState(false)
    const [label11, setlabel11] = useState(false)
    const [label12, setlabel12] = useState(false)
    const [label13, setlabel13] = useState(false)
    const [label14, setlabel14] = useState(false)
    const [label15, setlabel15] = useState(false)
    const defalutPeriod: string = CalculateDate(2);
    const [period, setPeriod] = useState(defalutPeriod)


    const onChange = (event: boolean, label: string, setState: any) => {
        setState(event)
        // console.log(` label ${label} evnet ${event}`);
    }



    const RadioHandleChange = (e: any) => {
        setPeriod(e.target.value)
        // console.log(`period change ${e.target.value}`)
    }


    return (
        <div>
            <div className="text-sm-center m-3">
                <h1>Petroleum Weekly Stocks</h1>
            </div>

            <Grid className="d-sm-flex my-sm-3">
                <FormControl className="mx-sm-auto bg-white shadow-sm border rounded px-3 pt-3">
                    <FormLabel id="demo-radio-buttons-group-label">Period</FormLabel>
                    <RadioGroup
                        aria-labelledby="demo-radio-buttons-group-label"
                        defaultValue={CalculateDate(2)}
                        name="radio-buttons-group"
                        onChange={RadioHandleChange}
                        className="flex-row"
                    >
                        <FormControlLabel value={CalculateDate(1)} control={<Radio />} label="1Year" />
                        <FormControlLabel value={CalculateDate(2)} control={<Radio />} label="2Years" />
                        <FormControlLabel value={CalculateDate(10)} control={<Radio />} label="10Years" />
                    </RadioGroup>
                </FormControl>
            </Grid>

            <Grid container className="my-sm-3">
                <FormControl className="d-sm-flex mx-sm-auto">
                    <Grid item className="my-sm-2 bg-white shadow-sm border rounded px-3 pt-3">
                        <h3>Crude Oil</h3>
                        <FormLabel>area</FormLabel>
                        <FormGroup className="flex-row">
                            <CheckboxAdapter onChange={onChange} label="PADD1" setState={setlabel1} />
                            <CheckboxAdapter onChange={onChange} label="PADD2" setState={setlabel2} />
                            <CheckboxAdapter onChange={onChange} label="PADD3" setState={setlabel3} checked={true} />
                            <CheckboxAdapter onChange={onChange} label="PADD4" setState={setlabel4} />
                            <CheckboxAdapter onChange={onChange} label="PADD5" setState={setlabel5} />
                        </FormGroup>

                        <IsChart display={label1} area={"R10"} product={"EPC0"} period={period} />
                        <IsChart display={label2} area={"R20"} product={"EPC0"} period={period} />
                        <IsChart display={label3} area={"R30"} product={"EPC0"} period={period} />
                        <IsChart display={label4} area={"R40"} product={"EPC0"} period={period} />
                        <IsChart display={label5} area={"R50"} product={"EPC0"} period={period} />

                    </Grid>

                    <Grid item className="my-sm-2 bg-white shadow-sm border rounded p-3">
                        <h3>Distillate Fuel Oil</h3>
                        <FormLabel>area</FormLabel>
                        <FormGroup className="flex-row">
                            <CheckboxAdapter onChange={onChange} label="PADD1" setState={setlabel6} />
                            <CheckboxAdapter onChange={onChange} label="PADD2" setState={setlabel7} />
                            <CheckboxAdapter onChange={onChange} label="PADD3" setState={setlabel8} />
                            <CheckboxAdapter onChange={onChange} label="PADD4" setState={setlabel9} />
                            <CheckboxAdapter onChange={onChange} label="PADD5" setState={setlabel10} />
                        </FormGroup>

                        <IsChart display={label6} area={"R10"} product={"EPD0"} period={period} />
                        <IsChart display={label7} area={"R20"} product={"EPD0"} period={period} />
                        <IsChart display={label8} area={"R30"} product={"EPD0"} period={period} />
                        <IsChart display={label9} area={"R40"} product={"EPD0"} period={period} />
                        <IsChart display={label10} area={"R50"} product={"EPD0"} period={period} />
                    </Grid>

                    <Grid item className="my-sm-2 bg-white shadow-sm border rounded px-3 pt-3">
                        <h3>Total Gasoline</h3>
                        <FormLabel>area</FormLabel>
                        <FormGroup className="flex-row">
                            <CheckboxAdapter onChange={onChange} label="PADD1" setState={setlabel11} />
                            <CheckboxAdapter onChange={onChange} label="PADD2" setState={setlabel12} />
                            <CheckboxAdapter onChange={onChange} label="PADD3" setState={setlabel13} />
                            <CheckboxAdapter onChange={onChange} label="PADD4" setState={setlabel14} />
                            <CheckboxAdapter onChange={onChange} label="PADD5" setState={setlabel15} />
                        </FormGroup>

                        <IsChart display={label11} area={"R10"} product={"EPM0"} period={period} />
                        <IsChart display={label12} area={"R20"} product={"EPM0"} period={period} />
                        <IsChart display={label13} area={"R30"} product={"EPM0"} period={period} />
                        <IsChart display={label14} area={"R40"} product={"EPM0"} period={period} />
                        <IsChart display={label15} area={"R50"} product={"EPM0"} period={period} />
                    </Grid>
                </FormControl>


            </Grid>

        </div>
    )
}


// 今日からN日前を計算
const CalculateDate = (subYear: number): string => {
    // preparde
    let dt: Date = new Date()
    // END  prepared

    dt.setFullYear(dt.getFullYear() - subYear);
    let result = `${dt.getFullYear()}-${dt.getMonth() + 1}-${dt.getDate()} `.replace(/\n|\r/g, '');
    // console.log(`result date ${result}`)
    return result;
}

const CheckboxAdapter = (props: any) => (
    <FormControlLabel
        control={<Checkbox onChange={e => props.onChange(e.target.checked, props.label, props.setState)} />}
        label={props.label}
    />
)


// 正ならチャート表示
const IsChart = (props: any) => {
    return (
        <>
            {
                props.display &&
                <ValidateAndDisplayChart display={props.display} label={props.label} area={props.area} product={props.product} period={props.period} />

            }
        </>
    );

}



// 取得したデータが届いたのを確認して表示する
const ValidateAndDisplayChart = (props: any) => {

    let stocks: any;
    let error: any;
    let loading: any;
    if (props.period == null) {
        props.period = '2000-01-01';
    }

    [stocks, error, loading] = useAxios({
        axiosInstance: axios,
        method: 'GET',
        url: '/stocks/' + props.area + '/' + props.product + '/' + props.period,
    });



    let data: number[] = [];
    let period: string[] = [];
    let area: string = "";
    let product: string = "";
    let series: string = "";
    // let when_period: string = "2022-06-01"; // 出力するデータをいつまでにするか？

    let InsertData = () => {
        stocks.map((item: any) => {
            data.push(item.value);
            period.push(item.period);
        })

        let procuct_name: string = ''
        if (props.product == "EPC0") {
            procuct_name = 'Crude Oil'
        } else if (props.product == "EPD0") {
            procuct_name = 'Distillate Fuel Oil'
        } else if (props.product == "EPM0") {
            procuct_name = 'Total Gasoline'
        }

        product = procuct_name;
        area = props.area;
    }

    return (
        <div>
            {loading && <p>Loading...</p>}
            {!loading && error && <p className="err__msg">{JSON.stringify(error)}</p>}
            {loading && !error && !stocks && <p>No Content</p>}
            {!loading && !error && stocks !== null && InsertData()}
            {data !== null && period !== null && product !== '' && series !== null && <DisplayChart area={area} period={period} product={product} series={series} data={data} />}
        </div >
    );
};


export default Stocks