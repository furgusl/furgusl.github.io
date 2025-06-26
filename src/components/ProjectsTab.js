import "./ProjectsTab.css"

const ProjectsTab = () => {
    return (
        <>
            <div className="card-tab-content active ">
                <div className="card-content-inner">
                    <section className="projects">
                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/Critical Banking.png")} alt="Critical Banking" />
                                </figure>
                                <div className="project-body">
                                    <h2>Critical Banking Website</h2>
                                    <p>
                                        Banking website with functional backend utilizing SQL and HTML, and PHP for the frontend. XAMPP hosts the backend on my local device so only the frontend will work. I can do a live demo of the project if interested! 
                                    </p>
                                    <a href="/furgusl.github.io/banking/index2.html" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        
                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/sleep_code.png")} alt="code img" />
                                </figure>
                                <div className="project-body">
                                    <h2>Sleep Predictor Neural Network</h2>
                                    <p>
                                        Utilizing linear regression neural network from sklearn and torch to predict the sleep efficiency of a person given variable such as light percent, sleep duration, and more. The dataset is "Sleep efficiency" from kaggle. 
                                    </p>
                                    <a href="https://colab.research.google.com/drive/1sQhzF8rZ5tSm-og-OfNQSdETlF6kkcp3?usp=sharing" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/text_summarizers.png")} alt="code img" />
                                </figure>
                                <div className="project-body">
                                    <h2>Abstractive Text Summarization Using LLM Transfomers</h2>
                                    <p>
                                        Develop an abstractive text summarization model using transformers that can create concise and coherent summaries for longer articles from the CNN/DailyMail dataset. Or any other articles.
                                    </p>
                                    <a href="https://drive.google.com/file/d/10C6aphRpPbRE1f-sZCefFICsw7XQFD2F/view?usp=sharing" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/Code_Optimization.png")} alt="code img" />
                                </figure>
                                <div className="project-body">
                                    <h2>Code Optimization Practices</h2>
                                    <p>
                                        Practice high performance computing using the Principles of Loop Optimization. The language used is C.
                                    </p>
                                    <a href="https://colab.research.google.com/drive/16qZZlOmgW3fW2bDlfOu1AywkqqAkwuo4?usp=sharing" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        
                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/Mandelbrot.png")} alt="Mandelbrot pic" />
                                </figure>
                                <div className="project-body">
                                    <h2>Mandelbrot Set CUDA Optimization</h2>
                                    <p>
                                        Utilize CUDA to optimization the generation of the Mandelbrot Set. The speeds was compared using C vs using CUDA.
                                    </p>
                                    <a href="https://colab.research.google.com/drive/1BTfdi9cffOwPh_dXmBthatgQeF7BZbw-?usp=sharing" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <article>
                            <div className="project-wrapper">
                                <figure>
                                    <img src={require("../img/amazon.png")} alt="Amazon prices vs discount png" />
                                </figure>
                                <div className="project-body">
                                    <h2>Data Analysis & visualizations Amazon-Sales</h2>
                                    <p>
                                        Discovering trends with in the Amazon Sales dataset from Kaggle.
                                    </p>
                                    <a href="https://colab.research.google.com/drive/1r6LbdIFeO2R54m9jxMpBztHrjfiL6DuI?usp=sharing" className="read-more"> Visit Project 
                                        <span className="sr-only">about this is some title</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </>
    )
};

export default ProjectsTab