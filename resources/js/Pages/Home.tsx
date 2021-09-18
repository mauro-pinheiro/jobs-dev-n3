import React from "react";
import Dashboard from "../components/dashboard/Dashboard";

const Home = ({reports}) => {
    console.log(reports)
    return <Dashboard reports={reports}/>
};

export default Home;