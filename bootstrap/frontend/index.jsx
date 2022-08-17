import React from "react";
import {createRoot} from "react-dom/client";
import {HashRouter, Routes, Route} from "react-router-dom";

const Root = () => {
    return (
        <HashRouter>
            <Routes>
                <Route path="/">

                </Route>
            </Routes>
        </HashRouter>
    );
};

const container = document.getElementById("app");
const root = createRoot(container);
root.render(<Root/>);