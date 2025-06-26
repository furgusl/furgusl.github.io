import React, { useEffect, useRef } from "react";
import "./ContactForm.css"  

const ContactForm = ({ isVisible, onClose }) => {
    const formRef = useRef();

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (formRef.current && !formRef.current.contains(event.target)) {
        onClose(); // close the form if clicked outside
      }
    };

    if (isVisible) {
      document.addEventListener("mousedown", handleClickOutside);
    }

    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, [isVisible, onClose]);
  
    return (
        <>
            <div className={`contact-form ${isVisible ? "show" : ""}`} id="contact-form" ref={formRef}>
                <a href="#" onClick={(e) => { e.preventDefault(); onClose(); }}>
                    <i className="fa fa-times"></i>
                </a>

                <form action="https://formspree.io/f/xkgglrro" method="POST">
                    <div className="control">
                        <input type="text" name="name" id="name" required />
                        <label htmlFor="name">Your Name</label>
                    </div>
                    <div className="control">
                        <input type="email" name="email" id="email" required />
                        <label htmlFor="email">Email Address</label>
                    </div>
                    <div className="control">
                        <textarea name="message" id="message" required></textarea>
                        <label htmlFor="message">Message</label>
                    </div>
                    <div className="control submit">
                        <input type="submit" value="Send Message" />
                    </div>
                </form>
            </div>
        </>
    )
};

export default ContactForm;