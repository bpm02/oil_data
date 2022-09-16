
const DisplayList = (props: any) => {
    return (
        <>
            <ul>
                {props.obj.map((item: any) =>
                    <li>{item.value}</li>
                )}
            </ul>
        </>
    );
}


export default DisplayList