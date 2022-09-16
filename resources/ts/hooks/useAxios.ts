
import { useState, useEffect } from 'react';

const useAxios = (configObj: any) => {
    const {
        axiosInstance,
        method,
        url,
        requestConfig = {}
    } = configObj;

    const [response, setResponse] = useState([]);
    const [error, setError] = useState('');
    const [loading, setLoading] = useState(true);
    const [reload, setReload] = useState(0);

    useEffect(() => {
        const controller = new AbortController();
        let isMounted = true;
        const fetchData = async () => {
            try {
                // console.log(`API URL ${url}`);
                const res = await axiosInstance[method.toLowerCase()](url, {
                    ...requestConfig,
                    signal: controller.signal
                });
                // console.log(res);
                setResponse(res.data);
            } catch (err: any) {
                console.log(`error ${JSON.stringify(err)}`);
                setError(err.message);
            } finally {
                setLoading(false);
            }
        }

        fetchData();

        // useeffect cleanup function
        return () => controller.abort();
    }, [])

    return [response, error, loading];
}

export default useAxios