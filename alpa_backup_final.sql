--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5 (Debian 17.5-1.pgdg120+1)
-- Dumped by pg_dump version 17.4

-- Started on 2025-06-13 23:09:30 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 241 (class 1255 OID 16613)
-- Name: auto_add_event_user(); Type: FUNCTION; Schema: public; Owner: alpa_admin
--

CREATE FUNCTION public.auto_add_event_user() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO event_user (event_id, user_id)
    SELECT r.event_id, NEW.user_id
    FROM room r
    WHERE r.room_id = NEW.room_id
    ON CONFLICT DO NOTHING;

    RETURN NEW;
END;
$$;


ALTER FUNCTION public.auto_add_event_user() OWNER TO alpa_admin;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 226 (class 1259 OID 16442)
-- Name: chat; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.chat (
    chat_id integer NOT NULL,
    room_id integer NOT NULL
);


ALTER TABLE public.chat OWNER TO alpa_admin;

--
-- TOC entry 225 (class 1259 OID 16441)
-- Name: Chat_chat_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Chat_chat_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Chat_chat_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3507 (class 0 OID 0)
-- Dependencies: 225
-- Name: Chat_chat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Chat_chat_id_seq" OWNED BY public.chat.chat_id;


--
-- TOC entry 224 (class 1259 OID 16426)
-- Name: event_plan_item; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.event_plan_item (
    event_plan_item_id integer NOT NULL,
    room_id integer NOT NULL,
    content text NOT NULL,
    "order" integer
);


ALTER TABLE public.event_plan_item OWNER TO alpa_admin;

--
-- TOC entry 223 (class 1259 OID 16425)
-- Name: Event Plan_event_plan_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Event Plan_event_plan_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Event Plan_event_plan_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3508 (class 0 OID 0)
-- Dependencies: 223
-- Name: Event Plan_event_plan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Event Plan_event_plan_id_seq" OWNED BY public.event_plan_item.event_plan_item_id;


--
-- TOC entry 228 (class 1259 OID 16454)
-- Name: event_settlements; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.event_settlements (
    event_settlements_id integer NOT NULL,
    room_id integer NOT NULL,
    user1_id integer NOT NULL,
    user2_id integer NOT NULL,
    ammount numeric(10,2) NOT NULL,
    currency text NOT NULL
);


ALTER TABLE public.event_settlements OWNER TO alpa_admin;

--
-- TOC entry 227 (class 1259 OID 16453)
-- Name: Event Settlements_event_settlements_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Event Settlements_event_settlements_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Event Settlements_event_settlements_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3509 (class 0 OID 0)
-- Dependencies: 227
-- Name: Event Settlements_event_settlements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Event Settlements_event_settlements_id_seq" OWNED BY public.event_settlements.event_settlements_id;


--
-- TOC entry 218 (class 1259 OID 16390)
-- Name: event; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.event (
    event_id integer NOT NULL,
    event_date timestamp without time zone NOT NULL,
    description text,
    event_name character varying(50) NOT NULL,
    event_type character varying(8) NOT NULL,
    event_location character varying(40) NOT NULL,
    photo character varying(100)
);


ALTER TABLE public.event OWNER TO alpa_admin;

--
-- TOC entry 217 (class 1259 OID 16389)
-- Name: Event_Event_ID_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Event_Event_ID_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Event_Event_ID_seq" OWNER TO alpa_admin;

--
-- TOC entry 3510 (class 0 OID 0)
-- Dependencies: 217
-- Name: Event_Event_ID_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Event_Event_ID_seq" OWNED BY public.event.event_id;


--
-- TOC entry 222 (class 1259 OID 16412)
-- Name: gallery; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.gallery (
    gallery_id integer NOT NULL,
    room_id integer NOT NULL
);


ALTER TABLE public.gallery OWNER TO alpa_admin;

--
-- TOC entry 221 (class 1259 OID 16411)
-- Name: Gallery_gallery_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Gallery_gallery_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Gallery_gallery_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3511 (class 0 OID 0)
-- Dependencies: 221
-- Name: Gallery_gallery_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Gallery_gallery_id_seq" OWNED BY public.gallery.gallery_id;


--
-- TOC entry 234 (class 1259 OID 16519)
-- Name: message; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.message (
    message_id integer NOT NULL,
    chat_id integer NOT NULL,
    user_id integer NOT NULL,
    content text NOT NULL,
    sent_at timestamp(6) without time zone NOT NULL
);


ALTER TABLE public.message OWNER TO alpa_admin;

--
-- TOC entry 233 (class 1259 OID 16518)
-- Name: Message_message_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Message_message_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Message_message_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3512 (class 0 OID 0)
-- Dependencies: 233
-- Name: Message_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Message_message_id_seq" OWNED BY public.message.message_id;


--
-- TOC entry 236 (class 1259 OID 16538)
-- Name: photo; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.photo (
    photo_id integer NOT NULL,
    gallery_id integer NOT NULL,
    user_id integer NOT NULL,
    sent_at timestamp(6) without time zone NOT NULL,
    target_path text NOT NULL
);


ALTER TABLE public.photo OWNER TO alpa_admin;

--
-- TOC entry 235 (class 1259 OID 16537)
-- Name: Photos_photo_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Photos_photo_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Photos_photo_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3513 (class 0 OID 0)
-- Dependencies: 235
-- Name: Photos_photo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Photos_photo_id_seq" OWNED BY public.photo.photo_id;


--
-- TOC entry 220 (class 1259 OID 16399)
-- Name: room; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.room (
    room_id integer NOT NULL,
    event_id integer NOT NULL,
    created_at timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.room OWNER TO alpa_admin;

--
-- TOC entry 219 (class 1259 OID 16398)
-- Name: Room_room_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."Room_room_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."Room_room_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3514 (class 0 OID 0)
-- Dependencies: 219
-- Name: Room_room_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."Room_room_id_seq" OWNED BY public.room.room_id;


--
-- TOC entry 230 (class 1259 OID 16463)
-- Name: alpa_user; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.alpa_user (
    user_id integer NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(254) NOT NULL,
    username character varying(20) NOT NULL,
    privileges text
);


ALTER TABLE public.alpa_user OWNER TO alpa_admin;

--
-- TOC entry 229 (class 1259 OID 16462)
-- Name: User_user_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public."User_user_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."User_user_id_seq" OWNER TO alpa_admin;

--
-- TOC entry 3515 (class 0 OID 0)
-- Dependencies: 229
-- Name: User_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public."User_user_id_seq" OWNED BY public.alpa_user.user_id;


--
-- TOC entry 232 (class 1259 OID 16476)
-- Name: room_user; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.room_user (
    room_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.room_user OWNER TO alpa_admin;

--
-- TOC entry 240 (class 1259 OID 16609)
-- Name: active_user_rooms; Type: VIEW; Schema: public; Owner: alpa_admin
--

CREATE VIEW public.active_user_rooms AS
 SELECT u.user_id,
    u.username,
    r.room_id,
    e.event_name
   FROM (((public.alpa_user u
     JOIN public.room_user ru ON ((u.user_id = ru.user_id)))
     JOIN public.room r ON ((ru.room_id = r.room_id)))
     JOIN public.event e ON ((e.event_id = r.event_id)));


ALTER VIEW public.active_user_rooms OWNER TO alpa_admin;

--
-- TOC entry 231 (class 1259 OID 16471)
-- Name: event_user; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.event_user (
    event_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE public.event_user OWNER TO alpa_admin;

--
-- TOC entry 237 (class 1259 OID 16561)
-- Name: friendship; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.friendship (
    user_id integer NOT NULL,
    friend_id integer NOT NULL,
    CONSTRAINT check_friend CHECK ((user_id <> friend_id))
);


ALTER TABLE public.friendship OWNER TO alpa_admin;

--
-- TOC entry 239 (class 1259 OID 16590)
-- Name: sticky_note; Type: TABLE; Schema: public; Owner: alpa_admin
--

CREATE TABLE public.sticky_note (
    note_id integer NOT NULL,
    room_id integer NOT NULL,
    content text DEFAULT ' '::text,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.sticky_note OWNER TO alpa_admin;

--
-- TOC entry 238 (class 1259 OID 16589)
-- Name: sticky_note_note_id_seq; Type: SEQUENCE; Schema: public; Owner: alpa_admin
--

CREATE SEQUENCE public.sticky_note_note_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sticky_note_note_id_seq OWNER TO alpa_admin;

--
-- TOC entry 3516 (class 0 OID 0)
-- Dependencies: 238
-- Name: sticky_note_note_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: alpa_admin
--

ALTER SEQUENCE public.sticky_note_note_id_seq OWNED BY public.sticky_note.note_id;


--
-- TOC entry 3279 (class 2604 OID 16466)
-- Name: alpa_user user_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.alpa_user ALTER COLUMN user_id SET DEFAULT nextval('public."User_user_id_seq"'::regclass);


--
-- TOC entry 3277 (class 2604 OID 16445)
-- Name: chat chat_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.chat ALTER COLUMN chat_id SET DEFAULT nextval('public."Chat_chat_id_seq"'::regclass);


--
-- TOC entry 3272 (class 2604 OID 16393)
-- Name: event event_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event ALTER COLUMN event_id SET DEFAULT nextval('public."Event_Event_ID_seq"'::regclass);


--
-- TOC entry 3276 (class 2604 OID 16429)
-- Name: event_plan_item event_plan_item_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_plan_item ALTER COLUMN event_plan_item_id SET DEFAULT nextval('public."Event Plan_event_plan_id_seq"'::regclass);


--
-- TOC entry 3278 (class 2604 OID 16457)
-- Name: event_settlements event_settlements_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_settlements ALTER COLUMN event_settlements_id SET DEFAULT nextval('public."Event Settlements_event_settlements_id_seq"'::regclass);


--
-- TOC entry 3275 (class 2604 OID 16415)
-- Name: gallery gallery_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.gallery ALTER COLUMN gallery_id SET DEFAULT nextval('public."Gallery_gallery_id_seq"'::regclass);


--
-- TOC entry 3280 (class 2604 OID 16522)
-- Name: message message_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.message ALTER COLUMN message_id SET DEFAULT nextval('public."Message_message_id_seq"'::regclass);


--
-- TOC entry 3281 (class 2604 OID 16541)
-- Name: photo photo_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.photo ALTER COLUMN photo_id SET DEFAULT nextval('public."Photos_photo_id_seq"'::regclass);


--
-- TOC entry 3273 (class 2604 OID 16402)
-- Name: room room_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room ALTER COLUMN room_id SET DEFAULT nextval('public."Room_room_id_seq"'::regclass);


--
-- TOC entry 3282 (class 2604 OID 16593)
-- Name: sticky_note note_id; Type: DEFAULT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.sticky_note ALTER COLUMN note_id SET DEFAULT nextval('public.sticky_note_note_id_seq'::regclass);


--
-- TOC entry 3492 (class 0 OID 16463)
-- Dependencies: 230
-- Data for Name: alpa_user; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.alpa_user (user_id, password, email, username, privileges) FROM stdin;
3	$2y$10$UJazMJr5oAklaUwIAbtRHe4jvFCnLAkIUo6xEAVnqScULHL7cPCGm	dziksonnns@gmail.com	nikusi	\N
4	$2y$10$iON7rrXBHGkz0p8zaJ9y2uq6bsS5CXm24qGxPV50N6AkWWctazgXG	Milos@Ankos.pl	Milos	\N
2	$2y$10$w7498Ma2pyNVgT4MByoRT.bgsxIGmojzAlIO8cDTpS7rOm6hRM9Le	mrszymut@gmail.com	Szymut	\N
15	$2y$10$LFZUbXMGezkSARM85StaeeIBzSolS0TVFOxX5TKJN2uI.0X9WK5Aa	admin@admin.pl	admin	admin
\.


--
-- TOC entry 3488 (class 0 OID 16442)
-- Dependencies: 226
-- Data for Name: chat; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.chat (chat_id, room_id) FROM stdin;
\.


--
-- TOC entry 3480 (class 0 OID 16390)
-- Dependencies: 218
-- Data for Name: event; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.event (event_id, event_date, description, event_name, event_type, event_location, photo) FROM stdin;
23	2025-05-03 15:00:00	teest	Test event	public	Kraków, Polska	./uploads/68289aff18411_images.jpg
24	2025-05-03 15:00:00	teest	Test event	public	Kraków, Polska	./uploads/68289b56f0736_images.jpg
25	2026-05-03 03:05:00	Test	Test event	public	Kraków, Polska	./uploads/682bac3a93554_Zrzut ekranu 2024-12-07 141007.png
\.


--
-- TOC entry 3486 (class 0 OID 16426)
-- Dependencies: 224
-- Data for Name: event_plan_item; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.event_plan_item (event_plan_item_id, room_id, content, "order") FROM stdin;
4	17	Rynek	\N
5	17	Bar	\N
6	17	Koncert	\N
8	7	Meeting	\N
\.


--
-- TOC entry 3490 (class 0 OID 16454)
-- Dependencies: 228
-- Data for Name: event_settlements; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.event_settlements (event_settlements_id, room_id, user1_id, user2_id, ammount, currency) FROM stdin;
\.


--
-- TOC entry 3493 (class 0 OID 16471)
-- Dependencies: 231
-- Data for Name: event_user; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.event_user (event_id, user_id) FROM stdin;
23	2
24	2
25	2
23	3
25	3
25	4
23	4
\.


--
-- TOC entry 3499 (class 0 OID 16561)
-- Dependencies: 237
-- Data for Name: friendship; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.friendship (user_id, friend_id) FROM stdin;
2	3
2	4
2	5
\.


--
-- TOC entry 3484 (class 0 OID 16412)
-- Dependencies: 222
-- Data for Name: gallery; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.gallery (gallery_id, room_id) FROM stdin;
1	17
\.


--
-- TOC entry 3496 (class 0 OID 16519)
-- Dependencies: 234
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.message (message_id, chat_id, user_id, content, sent_at) FROM stdin;
\.


--
-- TOC entry 3498 (class 0 OID 16538)
-- Dependencies: 236
-- Data for Name: photo; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.photo (photo_id, gallery_id, user_id, sent_at, target_path) FROM stdin;
43	1	2	2025-06-03 22:57:35.744082	uploads/1.jpg
44	1	2	2025-06-03 22:58:57.586708	uploads/2.jpg
45	1	2	2025-06-03 23:10:38.551029	uploads/2.jpg
46	1	2	2025-06-03 23:12:20.056265	uploads/1.jpg
47	1	2	2025-06-03 23:19:03.76544	uploads/Zrzut ekranu 2025-01-20 231042.png
48	1	2	2025-06-09 19:37:01.560421	uploads/Zrzut ekranu 2025-03-18 142828.png
\.


--
-- TOC entry 3482 (class 0 OID 16399)
-- Dependencies: 220
-- Data for Name: room; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.room (room_id, event_id, created_at) FROM stdin;
2	24	2025-05-17 14:58:03.781437
3	25	2025-05-19 22:10:10.213984
4	25	2025-05-20 20:56:05.175882
5	25	2025-05-20 20:56:53.889548
6	24	2025-05-20 20:58:35.88902
7	24	2025-05-20 20:58:43.020862
8	23	2025-05-20 21:02:56.972544
9	23	2025-05-20 21:04:13.403322
10	23	2025-05-20 21:05:21.036851
11	23	2025-05-20 21:08:38.568819
12	23	2025-05-20 21:10:24.484169
13	23	2025-05-20 21:12:21.475963
14	23	2025-05-20 21:12:31.550071
15	23	2025-05-20 21:13:52.762717
16	23	2025-05-20 21:15:09.343154
17	23	2025-06-02 11:33:50.002479
18	25	2025-06-13 23:06:25.020183
\.


--
-- TOC entry 3494 (class 0 OID 16476)
-- Dependencies: 232
-- Data for Name: room_user; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.room_user (room_id, user_id) FROM stdin;
2	2
3	2
4	2
5	2
6	2
7	2
8	2
9	2
10	2
11	2
12	2
13	2
14	2
15	2
16	2
17	2
5	3
5	4
17	4
\.


--
-- TOC entry 3501 (class 0 OID 16590)
-- Dependencies: 239
-- Data for Name: sticky_note; Type: TABLE DATA; Schema: public; Owner: alpa_admin
--

COPY public.sticky_note (note_id, room_id, content, created_at) FROM stdin;
1	17	siema	2025-06-12 19:51:21.474727
2	17	ok1	2025-06-12 19:51:27.32352
3	17	ok2\n	2025-06-12 19:51:47.697954
4	17	ok3	2025-06-12 20:07:56.035005
5	17	ok4	2025-06-12 20:07:58.30226
6	17	ok5	2025-06-12 20:08:11.987241
7	17	ok6	2025-06-12 20:08:18.420264
8	17		2025-06-12 20:12:49.937417
10	17		2025-06-12 20:19:56.7776
9	17	advs	2025-06-12 20:18:13.223567
11	17	adsv	2025-06-12 21:48:16.844666
12	17	xdd	2025-06-12 21:48:20.941749
13	7		2025-06-12 22:31:26.17315
\.


--
-- TOC entry 3517 (class 0 OID 0)
-- Dependencies: 225
-- Name: Chat_chat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Chat_chat_id_seq"', 1, false);


--
-- TOC entry 3518 (class 0 OID 0)
-- Dependencies: 223
-- Name: Event Plan_event_plan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Event Plan_event_plan_id_seq"', 8, true);


--
-- TOC entry 3519 (class 0 OID 0)
-- Dependencies: 227
-- Name: Event Settlements_event_settlements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Event Settlements_event_settlements_id_seq"', 1, false);


--
-- TOC entry 3520 (class 0 OID 0)
-- Dependencies: 217
-- Name: Event_Event_ID_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Event_Event_ID_seq"', 25, true);


--
-- TOC entry 3521 (class 0 OID 0)
-- Dependencies: 221
-- Name: Gallery_gallery_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Gallery_gallery_id_seq"', 1, false);


--
-- TOC entry 3522 (class 0 OID 0)
-- Dependencies: 233
-- Name: Message_message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Message_message_id_seq"', 1, false);


--
-- TOC entry 3523 (class 0 OID 0)
-- Dependencies: 235
-- Name: Photos_photo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Photos_photo_id_seq"', 48, true);


--
-- TOC entry 3524 (class 0 OID 0)
-- Dependencies: 219
-- Name: Room_room_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."Room_room_id_seq"', 18, true);


--
-- TOC entry 3525 (class 0 OID 0)
-- Dependencies: 229
-- Name: User_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public."User_user_id_seq"', 15, true);


--
-- TOC entry 3526 (class 0 OID 0)
-- Dependencies: 238
-- Name: sticky_note_note_id_seq; Type: SEQUENCE SET; Schema: public; Owner: alpa_admin
--

SELECT pg_catalog.setval('public.sticky_note_note_id_seq', 13, true);


--
-- TOC entry 3301 (class 2606 OID 16470)
-- Name: alpa_user User_pkey; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.alpa_user
    ADD CONSTRAINT "User_pkey" PRIMARY KEY (user_id);


--
-- TOC entry 3297 (class 2606 OID 16447)
-- Name: chat pk_chat; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.chat
    ADD CONSTRAINT pk_chat PRIMARY KEY (chat_id);


--
-- TOC entry 3287 (class 2606 OID 16397)
-- Name: event pk_event; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event
    ADD CONSTRAINT pk_event PRIMARY KEY (event_id);


--
-- TOC entry 3303 (class 2606 OID 16492)
-- Name: event_user pk_event-user; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_user
    ADD CONSTRAINT "pk_event-user" PRIMARY KEY (user_id, event_id);


--
-- TOC entry 3295 (class 2606 OID 16431)
-- Name: event_plan_item pk_event_plan; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_plan_item
    ADD CONSTRAINT pk_event_plan PRIMARY KEY (event_plan_item_id);


--
-- TOC entry 3299 (class 2606 OID 16461)
-- Name: event_settlements pk_event_settlements; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_settlements
    ADD CONSTRAINT pk_event_settlements PRIMARY KEY (event_settlements_id);


--
-- TOC entry 3311 (class 2606 OID 16566)
-- Name: friendship pk_friendship_user_friend; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.friendship
    ADD CONSTRAINT pk_friendship_user_friend PRIMARY KEY (user_id, friend_id);


--
-- TOC entry 3291 (class 2606 OID 16417)
-- Name: gallery pk_gallery; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.gallery
    ADD CONSTRAINT pk_gallery PRIMARY KEY (gallery_id);


--
-- TOC entry 3307 (class 2606 OID 16526)
-- Name: message pk_message; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT pk_message PRIMARY KEY (message_id);


--
-- TOC entry 3313 (class 2606 OID 16599)
-- Name: sticky_note pk_note; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.sticky_note
    ADD CONSTRAINT pk_note PRIMARY KEY (note_id);


--
-- TOC entry 3309 (class 2606 OID 16545)
-- Name: photo pk_photo; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.photo
    ADD CONSTRAINT pk_photo PRIMARY KEY (photo_id);


--
-- TOC entry 3289 (class 2606 OID 16405)
-- Name: room pk_room; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT pk_room PRIMARY KEY (room_id);


--
-- TOC entry 3305 (class 2606 OID 16480)
-- Name: room_user pk_room_user_id; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room_user
    ADD CONSTRAINT pk_room_user_id PRIMARY KEY (room_id, user_id);


--
-- TOC entry 3293 (class 2606 OID 16424)
-- Name: gallery room_id; Type: CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.gallery
    ADD CONSTRAINT room_id UNIQUE (room_id);


--
-- TOC entry 3332 (class 2620 OID 16614)
-- Name: room_user trigger_auto_add_event_user; Type: TRIGGER; Schema: public; Owner: alpa_admin
--

CREATE TRIGGER trigger_auto_add_event_user AFTER INSERT ON public.room_user FOR EACH ROW EXECUTE FUNCTION public.auto_add_event_user();


--
-- TOC entry 3325 (class 2606 OID 16527)
-- Name: message fk_chat_message; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT fk_chat_message FOREIGN KEY (chat_id) REFERENCES public.chat(chat_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3321 (class 2606 OID 16498)
-- Name: event_user fk_event_event-user; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_user
    ADD CONSTRAINT "fk_event_event-user" FOREIGN KEY (event_id) REFERENCES public.event(event_id) NOT VALID;


--
-- TOC entry 3314 (class 2606 OID 16406)
-- Name: room fk_event_room; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room
    ADD CONSTRAINT fk_event_room FOREIGN KEY (event_id) REFERENCES public.event(event_id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 3329 (class 2606 OID 16572)
-- Name: friendship fk_friendship_friend; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.friendship
    ADD CONSTRAINT fk_friendship_friend FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id);


--
-- TOC entry 3330 (class 2606 OID 16567)
-- Name: friendship fk_friendship_user; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.friendship
    ADD CONSTRAINT fk_friendship_user FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id);


--
-- TOC entry 3327 (class 2606 OID 16546)
-- Name: photo fk_gallery_phot; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.photo
    ADD CONSTRAINT fk_gallery_phot FOREIGN KEY (gallery_id) REFERENCES public.gallery(gallery_id);


--
-- TOC entry 3331 (class 2606 OID 16600)
-- Name: sticky_note fk_note_room; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.sticky_note
    ADD CONSTRAINT fk_note_room FOREIGN KEY (room_id) REFERENCES public.room(room_id);


--
-- TOC entry 3317 (class 2606 OID 16448)
-- Name: chat fk_room_chat; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.chat
    ADD CONSTRAINT fk_room_chat FOREIGN KEY (room_id) REFERENCES public.room(room_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3316 (class 2606 OID 16434)
-- Name: event_plan_item fk_room_event_plan; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_plan_item
    ADD CONSTRAINT fk_room_event_plan FOREIGN KEY (room_id) REFERENCES public.room(room_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3315 (class 2606 OID 16418)
-- Name: gallery fk_room_gallery; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.gallery
    ADD CONSTRAINT fk_room_gallery FOREIGN KEY (room_id) REFERENCES public.room(room_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3323 (class 2606 OID 16486)
-- Name: room_user fk_room_room-user; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room_user
    ADD CONSTRAINT "fk_room_room-user" FOREIGN KEY (room_id) REFERENCES public.room(room_id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3318 (class 2606 OID 16556)
-- Name: event_settlements fk_settlements-room; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_settlements
    ADD CONSTRAINT "fk_settlements-room" FOREIGN KEY (room_id) REFERENCES public.room(room_id) NOT VALID;


--
-- TOC entry 3319 (class 2606 OID 16508)
-- Name: event_settlements fk_settlements-user1; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_settlements
    ADD CONSTRAINT "fk_settlements-user1" FOREIGN KEY (user1_id) REFERENCES public.alpa_user(user_id) NOT VALID;


--
-- TOC entry 3320 (class 2606 OID 16513)
-- Name: event_settlements fk_settlements-user2; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_settlements
    ADD CONSTRAINT "fk_settlements-user2" FOREIGN KEY (user2_id) REFERENCES public.alpa_user(user_id) NOT VALID;


--
-- TOC entry 3322 (class 2606 OID 16493)
-- Name: event_user fk_user_event-user; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.event_user
    ADD CONSTRAINT "fk_user_event-user" FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


--
-- TOC entry 3326 (class 2606 OID 16532)
-- Name: message fk_user_message; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.message
    ADD CONSTRAINT fk_user_message FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id);


--
-- TOC entry 3328 (class 2606 OID 16551)
-- Name: photo fk_user_photo; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.photo
    ADD CONSTRAINT fk_user_photo FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id);


--
-- TOC entry 3324 (class 2606 OID 16481)
-- Name: room_user fk_user_room-user; Type: FK CONSTRAINT; Schema: public; Owner: alpa_admin
--

ALTER TABLE ONLY public.room_user
    ADD CONSTRAINT "fk_user_room-user" FOREIGN KEY (user_id) REFERENCES public.alpa_user(user_id) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;


-- Completed on 2025-06-13 23:09:30 UTC

--
-- PostgreSQL database dump complete
--

