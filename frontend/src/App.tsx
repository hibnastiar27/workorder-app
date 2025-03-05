import React from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
// import { WorkorderPage, WorkorderDetailsPage, WorkorderReportPage } from "./pages/manage-workorder/index";

const App: React.FC = () => {
  return (
    <BrowserRouter>
      <Routes>
        {/* <Route path="/" element={<WorkorderPage />} /> */}
        {/* <Route path="/details" element={<WorkorderDetailsPage />} /> */}
        {/* <Route path="/report" element={<WorkorderReportPage />} /> */}
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
      </Routes>
    </BrowserRouter>
  )
}

export default App
