--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-2.pgdg20.04+1)
-- Dumped by pg_dump version 12.9 (Ubuntu 12.9-2.pgdg20.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE worldcup;
--
-- Name: worldcup; Type: DATABASE; Schema: -; Owner: freecodecamp
--

CREATE DATABASE worldcup WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C.UTF-8' LC_CTYPE = 'C.UTF-8';


ALTER DATABASE worldcup OWNER TO freecodecamp;

\connect worldcup

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: games; Type: TABLE; Schema: public; Owner: freecodecamp
--

CREATE TABLE public.games (
    game_id integer NOT NULL,
    year integer NOT NULL,
    winner_id integer NOT NULL,
    opponent_id integer NOT NULL,
    winner_goals integer NOT NULL,
    opponent_goals integer NOT NULL,
    round character varying(60) NOT NULL
);


ALTER TABLE public.games OWNER TO freecodecamp;

--
-- Name: games_game_id_seq; Type: SEQUENCE; Schema: public; Owner: freecodecamp
--

CREATE SEQUENCE public.games_game_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.games_game_id_seq OWNER TO freecodecamp;

--
-- Name: games_game_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: freecodecamp
--

ALTER SEQUENCE public.games_game_id_seq OWNED BY public.games.game_id;


--
-- Name: teams; Type: TABLE; Schema: public; Owner: freecodecamp
--

CREATE TABLE public.teams (
    team_id integer NOT NULL,
    name character varying(60) NOT NULL
);


ALTER TABLE public.teams OWNER TO freecodecamp;

--
-- Name: teams_team_id_seq; Type: SEQUENCE; Schema: public; Owner: freecodecamp
--

CREATE SEQUENCE public.teams_team_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.teams_team_id_seq OWNER TO freecodecamp;

--
-- Name: teams_team_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: freecodecamp
--

ALTER SEQUENCE public.teams_team_id_seq OWNED BY public.teams.team_id;


--
-- Name: games game_id; Type: DEFAULT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.games ALTER COLUMN game_id SET DEFAULT nextval('public.games_game_id_seq'::regclass);


--
-- Name: teams team_id; Type: DEFAULT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.teams ALTER COLUMN team_id SET DEFAULT nextval('public.teams_team_id_seq'::regclass);


--
-- Data for Name: games; Type: TABLE DATA; Schema: public; Owner: freecodecamp
--

INSERT INTO public.games VALUES (129, 2018, 238, 239, 4, 2, 'Final');
INSERT INTO public.games VALUES (130, 2018, 240, 241, 2, 0, 'Third Place');
INSERT INTO public.games VALUES (131, 2018, 239, 241, 2, 1, 'Semi-Final');
INSERT INTO public.games VALUES (132, 2018, 238, 240, 1, 0, 'Semi-Final');
INSERT INTO public.games VALUES (133, 2018, 239, 242, 3, 2, 'Quarter-Final');
INSERT INTO public.games VALUES (134, 2018, 241, 243, 2, 0, 'Quarter-Final');
INSERT INTO public.games VALUES (135, 2018, 240, 244, 2, 1, 'Quarter-Final');
INSERT INTO public.games VALUES (136, 2018, 238, 245, 2, 0, 'Quarter-Final');
INSERT INTO public.games VALUES (137, 2018, 241, 246, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (138, 2018, 243, 247, 1, 0, 'Eighth-Final');
INSERT INTO public.games VALUES (139, 2018, 240, 248, 3, 2, 'Eighth-Final');
INSERT INTO public.games VALUES (140, 2018, 244, 249, 2, 0, 'Eighth-Final');
INSERT INTO public.games VALUES (141, 2018, 239, 250, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (142, 2018, 242, 251, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (143, 2018, 245, 252, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (144, 2018, 238, 253, 4, 3, 'Eighth-Final');
INSERT INTO public.games VALUES (145, 2014, 254, 253, 1, 0, 'Final');
INSERT INTO public.games VALUES (146, 2014, 255, 244, 3, 0, 'Third Place');
INSERT INTO public.games VALUES (147, 2014, 253, 255, 1, 0, 'Semi-Final');
INSERT INTO public.games VALUES (148, 2014, 254, 244, 7, 1, 'Semi-Final');
INSERT INTO public.games VALUES (149, 2014, 255, 256, 1, 0, 'Quarter-Final');
INSERT INTO public.games VALUES (150, 2014, 253, 240, 1, 0, 'Quarter-Final');
INSERT INTO public.games VALUES (151, 2014, 244, 246, 2, 1, 'Quarter-Final');
INSERT INTO public.games VALUES (152, 2014, 254, 238, 1, 0, 'Quarter-Final');
INSERT INTO public.games VALUES (153, 2014, 244, 257, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (154, 2014, 246, 245, 2, 0, 'Eighth-Final');
INSERT INTO public.games VALUES (155, 2014, 238, 258, 2, 0, 'Eighth-Final');
INSERT INTO public.games VALUES (156, 2014, 254, 259, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (157, 2014, 255, 249, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (158, 2014, 256, 260, 2, 1, 'Eighth-Final');
INSERT INTO public.games VALUES (159, 2014, 253, 247, 1, 0, 'Eighth-Final');
INSERT INTO public.games VALUES (160, 2014, 240, 261, 2, 1, 'Eighth-Final');


--
-- Data for Name: teams; Type: TABLE DATA; Schema: public; Owner: freecodecamp
--

INSERT INTO public.teams VALUES (238, 'France');
INSERT INTO public.teams VALUES (239, 'Croatia');
INSERT INTO public.teams VALUES (240, 'Belgium');
INSERT INTO public.teams VALUES (241, 'England');
INSERT INTO public.teams VALUES (242, 'Russia');
INSERT INTO public.teams VALUES (243, 'Sweden');
INSERT INTO public.teams VALUES (244, 'Brazil');
INSERT INTO public.teams VALUES (245, 'Uruguay');
INSERT INTO public.teams VALUES (246, 'Colombia');
INSERT INTO public.teams VALUES (247, 'Switzerland');
INSERT INTO public.teams VALUES (248, 'Japan');
INSERT INTO public.teams VALUES (249, 'Mexico');
INSERT INTO public.teams VALUES (250, 'Denmark');
INSERT INTO public.teams VALUES (251, 'Spain');
INSERT INTO public.teams VALUES (252, 'Portugal');
INSERT INTO public.teams VALUES (253, 'Argentina');
INSERT INTO public.teams VALUES (254, 'Germany');
INSERT INTO public.teams VALUES (255, 'Netherlands');
INSERT INTO public.teams VALUES (256, 'Costa Rica');
INSERT INTO public.teams VALUES (257, 'Chile');
INSERT INTO public.teams VALUES (258, 'Nigeria');
INSERT INTO public.teams VALUES (259, 'Algeria');
INSERT INTO public.teams VALUES (260, 'Greece');
INSERT INTO public.teams VALUES (261, 'United States');


--
-- Name: games_game_id_seq; Type: SEQUENCE SET; Schema: public; Owner: freecodecamp
--

SELECT pg_catalog.setval('public.games_game_id_seq', 160, true);


--
-- Name: teams_team_id_seq; Type: SEQUENCE SET; Schema: public; Owner: freecodecamp
--

SELECT pg_catalog.setval('public.teams_team_id_seq', 261, true);


--
-- Name: games games_pkey; Type: CONSTRAINT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.games
    ADD CONSTRAINT games_pkey PRIMARY KEY (game_id);


--
-- Name: teams teams_pkey; Type: CONSTRAINT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.teams
    ADD CONSTRAINT teams_pkey PRIMARY KEY (team_id);


--
-- Name: teams unique_team; Type: CONSTRAINT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.teams
    ADD CONSTRAINT unique_team UNIQUE (name);


--
-- Name: games opponent_ref; Type: FK CONSTRAINT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.games
    ADD CONSTRAINT opponent_ref FOREIGN KEY (opponent_id) REFERENCES public.teams(team_id);


--
-- Name: games winner_ref; Type: FK CONSTRAINT; Schema: public; Owner: freecodecamp
--

ALTER TABLE ONLY public.games
    ADD CONSTRAINT winner_ref FOREIGN KEY (winner_id) REFERENCES public.teams(team_id);


--
-- PostgreSQL database dump complete
--


