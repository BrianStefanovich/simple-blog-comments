# simple-blog-comments
This is a simple PHP script to manage comments, and is what I use on my own blog [brianstefanovich.com/blog](brianstefanovich.com/blog).

# Installation

It's based on 3 tables:

### COMMENT

| Name | Key | Type | Null | Default | Extra |
| - | - | - | - | - | - |
| comment_id | primary | int(11) | No | None | AUTO_INCREMET |
| post_id | foreign | int(11) | No | None | - |
| user_id | foreign | int(11) | No | None | - |
| comment_body | - | text | No | - | - |
| comment_date | - | timestamp | Yes | CURRENT_TIMESTAMP | - |

### USER

| Name | Key | Type | Null | Default | Extra |
| - | - | - | - | - | - |
| user_id | primary | int(11) | No | None | AUTO_INCREMENT |
| user_name | varchar(60) | No | None | - | - |
| user_email | varchar(60) | Yes | NULL | - | - |

### POST

| Name | Key | Type | Null | Default | Extra |
| - | - | - | - | - | - |
| post_id | int(11) | No | None | - | - |
| post_title | varchar(256) | No | None | - | - |

Set them up, and modify env.php with your credentials.

## Usage

Endpoints are:

__getComments__ (GET) , that accept postTitle parameter and return an array with all comments:

| Name | Method | Parameters |
| - | - | - |
|getComment|GET|postTitle|

Will return :

```json
[{
"comment_body": "body",
"comment_date": "date",
"user_name": "name",
"post_title": "title"
}]
```

__setComment__ (POST) , that accept postName, authName, authEmail and comment parameters to register a new comment:

| Name | Method | Parameters |
| - | - | - |
|setComment|POST|postName, authName, authEmail, comment|

Will return a boolean with the INSERT status:

```json
{"status": true}
```

