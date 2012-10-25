--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: addresses; Type: TABLE; Schema: public; Owner: pgadmin; Tablespace: 
--

CREATE TABLE addresses (
    id integer NOT NULL,
    street character varying(200) NOT NULL,
    city character varying(30),
    province character varying(30),
    postal_code character(5),
    is_primary boolean DEFAULT false,
    created date,
    employee_nip character(10) NOT NULL
);


ALTER TABLE public.addresses OWNER TO pgadmin;

--
-- Name: addresses_id_seq; Type: SEQUENCE; Schema: public; Owner: pgadmin
--

CREATE SEQUENCE addresses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.addresses_id_seq OWNER TO pgadmin;

--
-- Name: addresses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pgadmin
--

ALTER SEQUENCE addresses_id_seq OWNED BY addresses.id;


--
-- Name: emails; Type: TABLE; Schema: public; Owner: pgadmin; Tablespace: 
--

CREATE TABLE emails (
    id integer NOT NULL,
    employee_nip character(10) NOT NULL,
    address character varying(100) NOT NULL,
    created date,
    is_primary boolean DEFAULT false
);


ALTER TABLE public.emails OWNER TO pgadmin;

--
-- Name: COLUMN emails.id; Type: COMMENT; Schema: public; Owner: pgadmin
--

COMMENT ON COLUMN emails.id IS 'seharusnya tidak perlu field ini, primary key bisa langsung diset dari employee nip, lihat colomn employee_nip';


--
-- Name: emails_id_seq; Type: SEQUENCE; Schema: public; Owner: pgadmin
--

CREATE SEQUENCE emails_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emails_id_seq OWNER TO pgadmin;

--
-- Name: emails_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pgadmin
--

ALTER SEQUENCE emails_id_seq OWNED BY emails.id;


--
-- Name: employees; Type: TABLE; Schema: public; Owner: pgadmin; Tablespace: 
--

CREATE TABLE employees (
    nip character(10) NOT NULL,
    first_name character varying(30) NOT NULL,
    middle_name character varying(30),
    last_name character varying(30),
    birth_place character varying(30) NOT NULL,
    birth_date date NOT NULL,
    sex character(10),
    created date
);


ALTER TABLE public.employees OWNER TO pgadmin;

--
-- Name: phones; Type: TABLE; Schema: public; Owner: pgadmin; Tablespace: 
--

CREATE TABLE phones (
    id integer NOT NULL,
    employee_nip character(10) NOT NULL,
    phone_number character(13) NOT NULL,
    phone_type integer,
    created date,
    is_primary boolean DEFAULT false
);


ALTER TABLE public.phones OWNER TO pgadmin;

--
-- Name: phones_id_seq; Type: SEQUENCE; Schema: public; Owner: pgadmin
--

CREATE SEQUENCE phones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.phones_id_seq OWNER TO pgadmin;

--
-- Name: phones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pgadmin
--

ALTER SEQUENCE phones_id_seq OWNED BY phones.id;


--
-- Name: photos; Type: TABLE; Schema: public; Owner: pgadmin; Tablespace: 
--

CREATE TABLE photos (
    id integer NOT NULL,
    file_name character varying(100) NOT NULL,
    employee_nip character(10) NOT NULL,
    is_profile boolean DEFAULT false,
    file_type character varying(25) NOT NULL,
    file_size bigint NOT NULL,
    created date,
    file_path character varying(255)
);


ALTER TABLE public.photos OWNER TO pgadmin;

--
-- Name: photos_id_seq; Type: SEQUENCE; Schema: public; Owner: pgadmin
--

CREATE SEQUENCE photos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.photos_id_seq OWNER TO pgadmin;

--
-- Name: photos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: pgadmin
--

ALTER SEQUENCE photos_id_seq OWNED BY photos.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY addresses ALTER COLUMN id SET DEFAULT nextval('addresses_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY emails ALTER COLUMN id SET DEFAULT nextval('emails_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY phones ALTER COLUMN id SET DEFAULT nextval('phones_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY photos ALTER COLUMN id SET DEFAULT nextval('photos_id_seq'::regclass);


--
-- Name: address_primary_key; Type: CONSTRAINT; Schema: public; Owner: pgadmin; Tablespace: 
--

ALTER TABLE ONLY addresses
    ADD CONSTRAINT address_primary_key PRIMARY KEY (id);


--
-- Name: email_primary_key; Type: CONSTRAINT; Schema: public; Owner: pgadmin; Tablespace: 
--

ALTER TABLE ONLY emails
    ADD CONSTRAINT email_primary_key PRIMARY KEY (id);


--
-- Name: employee_primary_key; Type: CONSTRAINT; Schema: public; Owner: pgadmin; Tablespace: 
--

ALTER TABLE ONLY employees
    ADD CONSTRAINT employee_primary_key PRIMARY KEY (nip);


--
-- Name: phone_primary_key; Type: CONSTRAINT; Schema: public; Owner: pgadmin; Tablespace: 
--

ALTER TABLE ONLY phones
    ADD CONSTRAINT phone_primary_key PRIMARY KEY (id);


--
-- Name: photo_primary_key; Type: CONSTRAINT; Schema: public; Owner: pgadmin; Tablespace: 
--

ALTER TABLE ONLY photos
    ADD CONSTRAINT photo_primary_key PRIMARY KEY (id);


--
-- Name: employee_nip_foreign_key; Type: FK CONSTRAINT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY emails
    ADD CONSTRAINT employee_nip_foreign_key FOREIGN KEY (employee_nip) REFERENCES employees(nip) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: employee_nip_foreign_key; Type: FK CONSTRAINT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY phones
    ADD CONSTRAINT employee_nip_foreign_key FOREIGN KEY (employee_nip) REFERENCES employees(nip) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: employee_nip_foreign_key; Type: FK CONSTRAINT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY addresses
    ADD CONSTRAINT employee_nip_foreign_key FOREIGN KEY (employee_nip) REFERENCES employees(nip) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: employee_nip_foreign_key; Type: FK CONSTRAINT; Schema: public; Owner: pgadmin
--

ALTER TABLE ONLY photos
    ADD CONSTRAINT employee_nip_foreign_key FOREIGN KEY (employee_nip) REFERENCES employees(nip);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

