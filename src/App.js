import React, { useEffect, useState } from "react";
import "./App.css";
import "animate.css";
import "font-awesome/css/font-awesome.min.css";

import ProfileTab from "./components/ProfileTab";
import ContactForm from "./components/ContactForm";
import ExperienceTab from "./components/ExperienceTab";
import ProjectsTab from "./components/ProjectsTab";

const App = () => {
  const [activeTab, setActiveTab] = useState("1");
  const [renderedTab, setRenderedTab] = useState("1");
  const [animationClass, setAnimationClass] = useState("animate__fadeInUpCustom");
  const [showContactForm, setShowContactForm] = useState(false);

  useEffect(() => {
    const timeout = setTimeout(() => resizeCard(renderedTab), 100);
    return () => clearTimeout(timeout);
  }, [renderedTab]);

  const resizeCard = (tabId) => {
    const card = document.getElementById("card-main");
    const viewportWidth = window.innerWidth;
    const viewportHeight = window.innerHeight;

    if (!card) return;

    if (tabId === "1") {
      card.style.maxWidth = `760px`;
      card.style.height = `600px`;
      card.classList.remove("scrollable");
    } else if (tabId === "2") {
      card.style.maxWidth = `900px`;
      card.style.height = `${viewportHeight - 50}px`;
      card.classList.add("scrollable");
    } else if (tabId === "3") {
      card.style.maxWidth = `${viewportWidth - 20}px`;
      card.style.height = `${viewportHeight - 50}px`;
      card.classList.add("scrollable");
    }
    card.style.transition = "all 0.4s ease";
  };

  const handleTabChange = (tabId) => {
    if (tabId === activeTab) return;

    setAnimationClass("animate__fadeOutDownCustom");

    setTimeout(() => {
      setRenderedTab(tabId);
      setActiveTab(tabId);
      setAnimationClass("animate__fadeInUpCustom");
    }, 400); // duration matches --animate-duration (0.4s)
  };

  const renderTabContent = () => {
    switch (renderedTab) {
      case "1":
        return <ProfileTab setShowContactForm={setShowContactForm} />;
      case "2":
        return <ExperienceTab />;
      case "3":
        return <ProjectsTab />;
      default:
        return null;
    }
  };

  return (
    <div id="card-main" className="animate__animated animate__fadeInUp">
      <div className="tab-container">
        <ul className="tab-menu">
          <li className={activeTab === "1" ? "active" : ""}>
            <a href="#" onClick={(e) => { e.preventDefault(); handleTabChange("1"); }}>
              <span className="fa fa-user icon"></span>
              <span className="menu-text">Profile</span>
            </a>
          </li>
          <li className={activeTab === "2" ? "active" : ""}>
            <a href="#" onClick={(e) => { e.preventDefault(); handleTabChange("2"); }}>
              <span className="fa fa-black-tie icon"></span>
              <span className="menu-text">Experience</span>
            </a>
          </li>
          <li className={activeTab === "3" ? "active" : ""}>
            <a href="#" onClick={(e) => { e.preventDefault(); handleTabChange("3"); }}>
              <span className="fa fa-rocket icon"></span>
              <span className="menu-text">Projects</span>
            </a>
          </li>
        </ul>

        <div
          className={`card-tab-content active animate__animated ${animationClass}`}
          style={{ "--animate-duration": "0.4s" }}
        >
          {renderTabContent()}
        </div>

        <ContactForm isVisible={showContactForm} onClose={() => setShowContactForm(false)}/>

        <footer id="card-footer">
          <div className="row">
            <div className="col-md-6 col-md-offset-3 text-center">
              <small>
                © 2025 Personal Website. All Rights Reserved. <span className="card-author">Leslie Furgus</span>
              </small>
            </div>
          </div>
        </footer>
      </div>
    </div>
  );
};

export default App;
