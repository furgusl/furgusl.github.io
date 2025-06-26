const ProfileTab = ({ setShowContactForm}) => {

    return (
        <>  
            <div className={`card-tab-content active `}>
                <div className="card-content-inner text-center">
                    <div className="row row-bottom-padded-sm">
                        <div className="col-md-12">
                            <h1>Leslie Furgus</h1>
                            <p>
                                Specializing and passionate in{" "}
                                <a href="#">Software Engineering</a>,{" "}
                                <a href="#">Machine Learning</a>, and{" "}
                                <a href="#">Data Analysis</a>, I utilize my strong foundation in
                                computational science to build robust software solutions, develop
                                intelligent machine learning models, and uncover actionable insights
                                from complex datasets.
                            </p>  
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12 card-counter">
                            <div className="card-number card-left">5</div>
                            <div className="card-text">
                                <h3 className="border-bottom">Years of experience in broad field of CS</h3>
                            </div>
                        </div>
                    </div>
                    <ul className="card-social">
                        <li>
                            <a href="#" onClick={(e) => { e.preventDefault(); setShowContactForm(true); }}>
                                <i className="fa fa-envelope icon"></i>
                            </a>
                        </li>
                        <li><a href="https://github.com/furgusl"><i className="fa fa-github icon"></i></a></li>
                        <li><a href="https://www.linkedin.com/in/leslie-furgus-246144199/"><i className="fa fa-linkedin icon"></i></a></li>
                    </ul>
                </div>
            </div>
        </>
    )
};

export default ProfileTab;