import "./ExperienceTab.css"

const ExperienceTab = ({isAnimating}) => {
    return (
        <>
            <div className={`card-tab-content active animate__animated ${isAnimating}`}>
                <div className="card-content-inner">
                    <section className="design-section">
                        <div className="timeline">
                            <div className="timeline-middle">
                              <div className="timeline-circle"></div>
                            </div>
                            <div className="timeline-content">
                                <h3>June 2024 - Aug. 2024</h3>
                                <h3>Operations Research Analyst</h3>
                                <h5>DEPARTMENT OF DEFENSE - OSD CAPE <br/> Washington, DC 20301-1400</h5>
                                <ul>
                                    <li>
                                        Automate extraction of 300+ Aerospace contractor reports within seconds using VBA, saving 20 hours per week of manual extraction 
                                    </li>
                                    <li>
                                        Utilize Excel pivot tables to analysis and discover trends within 400+ reports to estimate future contractor's labor rates for the next 4 Years 
                                    </li>
                                    <li>
                                        Provide PowerPoint briefs to DoD senior leadership to review the data findings/business requirements and prepare design documents
                                    </li> 
                                    <li>
                                        Help DoD cost estimators provide better analysis to DoD senior leadership on life cycle cost estimates for major acquisition programs that typically measure in billions of dollars. 
                                    </li> 
                                </ul>
                            </div>
                          
                            <div className="timeline-middle">
                              <div className="timeline-circle"></div>
                            </div>
                            <div className="timeline-content">
                                <h3>Sept. 2021 - Present </h3>
                                <h3>FULL STACK DEVELOPER</h3>
                                <ul>
                                    <li>
                                        Utilize Visual Studio Development for Front-End applications for user's bank transactions employing HTML, PHP, CSS to enhance user experience. 
                                    </li>
                                    <li>
                                        Integrated a MySQL database with PhpMyAdmin to facilitate the storage and management of 500+ user transactions.  
                                    </li>
                                    <li>
                                        Leveraged Node.js to create server-side web applications to improve performance and scalability with REST APIs/Web Service. 
                                    </li>
                                    <li>
                                        Implement E-commerce websites utilizing React, Angular, w/ Back-End application like MongoDB and SQLite 
                                    </li>
                                    <li>
                                        Incorporated AI technology using OpenAI's LLM functionality into customer service portals, improving user engagement and customer support response time.
                                    </li>
                                    <li>
                                        Summarized 100+ articles via Web Scraping with various NLP models to be displayed on website using MongoDB 
                                    </li>
                                </ul>
                            </div>
                          
                            <div className="timeline-middle">
                                <div className="timeline-circle"></div>
                              </div>
                              <div className="timeline-content">
                                  <h3>Sept. 2021 - May 2024</h3>
                                  <h3>CYBER SECURITY ENGINEER Intern</h3>
                                  <ul>
                                      <li>
                                            Implemented password cracking techniques using tools like John the Ripper to identify weak passwords, enhancing system security protocols. 
                                      </li>
                                      <li>
                                            Conducted vulnerability scanning with Nmap for identifying and prioritizing critical security flaws in ports and services on a host while researching them with through the Common Vulnerabilities and Exposures (CVE) database 
                                      </li>
                                      <li>
                                            Performed network traffic analysis using Wireshark, diagnosing issues related to TCP/IP protocols, and optimizing network security configurations.
                                      </li>
                                      <li>
                                            Applied cryptographic algorithms (AES, RSA) to secure communications, ensuring data confidentiality and integrity in various applications 
                                      </li>
                                  </ul>
                              </div>

                              <div className="timeline-middle">
                                <div className="timeline-circle"></div>
                              </div>
                              <div className="timeline-content">
                                  <h3>Sept. 2023 - Dec. 2023</h3>
                                  <h3>HIGH PERFORMANCE COMPUTING ENGINEER</h3>
                                  <ul>
                                      <li>
                                            Optimize workloads for efficient CPU/GPU usage by 11% in Bash programs  
                                      </li>
                                      <li>
                                            Integrate and maintain HPC cluster configuration to distributing computational load across multiple nodes 
                                      </li>
                                  </ul>
                              </div>

                              <div className="timeline-middle">
                                <div className="timeline-circle"></div>
                              </div>
                              <div className="timeline-content">
                                  <h3>Sept. 2023 - Dec. 2023</h3>
                                  <h3>DATA ANALYST</h3>
                                  <ul>
                                      <li>
                                            Utilize Python and R Studio to manipulation of complex data sets to be used for data visualizations  
                                      </li>
                                      <li>
                                            Create data visualizations using Tableau to enhance analytical reports readability 
                                      </li>
                                      <li>
                                            Work with complex machine learning models to make accurate predictions and estimations based on data
                                      </li>
                                      <li>
                                            Create a dataset of 100+ articles via Web Scraping to be used summarized various NLP models to be displayed on website using MongoDB 
                                      </li>
                                  </ul>
                              </div>

                              <div className="timeline-middle">
                                <div className="timeline-circle"></div>
                              </div>
                              <div className="timeline-content">
                                  <h3>Sept. 2022 - Dec. 2022</h3>
                                  <h3>SEASONAL SOFTWARE ENGINEER</h3>
                                  <h5>Clio Snacks <br/>Remote</h5>
                                  <ul>
                                      <li>
                                            Build an inventory management system w/ GUI for 1000+ products using SCRUM Agile tech utilizing VBA within 4-person team to increase worker efficiency by 20%
                                      </li>
                                      <li>
                                            Meeting deadlines and providing weekly updates w/clients in a fast-paced environment  
                                      </li>
                                  </ul>
                              </div>

                        </div>
                    </section>
                </div>  
            </div>
        </>
        
    )
}
  
export default ExperienceTab